<?

/**
 * Package Name: Stripe Pad
 * File Description: Invoices Model
 * 
 * @author Beto Ayesa <beto.phpninja@gmail.com>
 * @version 1.0.0
 * @package StripePad
 * @license GPL3
 * @link https://github.com/natzar/stripe-pad
 * 
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This file is part of Stripe Pad.
 *
 *	Stripe Pad is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 *
 *	Stripe Pad is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 *	You should have received a copy of the GNU General Public License along with  Stripe Pad. If not, see <https://www.gnu.org/licenses/>.
 */


use Dompdf\Dompdf;


/**
 * invoicesModel
 */
class invoicesModel extends ModelBase
{
	/**
	 * getById
	 *
	 * @param  int $id
	 * @return void
	 */
	public function getById($id)
	{
		$consulta = $this->db->prepare("SELECT *, invoices.created as created, invoices.iva as iva FROM invoices JOIN customers on (invoices.customersId = customers.customersId) where invoicesId=:id ");
		$consulta->bindParam(":id", $id);
		$consulta->execute();
		return $consulta->fetch();
	}

	/**
	 * getByUsersId
	 *
	 * @param  int $id
	 * @return void
	 */
	public function getByUsersId($id)
	{

		$consulta = $this->db->prepare("SELECT * FROM invoices where usersId=:id ");
		$consulta->bindParam(":id", $id);
		$consulta->execute();
		return $consulta->fetchAll();
	}

	/**
	 * getNextInvoiceId
	 * 
	 * @return String
	 */
	public function getNextInvoiceId()
	{

		$q = $this->db->prepare("SELECT * from invoices order by invoicesId DESC limit 1");
		$q->execute();
		$next = $q->fetch();
		$invoiceId = intval(substr($next['invoicesId'], 2, strlen($next['invoicesId'])));
		$invoiceId++;

		return "FA" . $invoiceId;
	}

	public function send($invoice)
	{
		$mails = new mailsModel();

		$subject = APP_NAME . " · Factura " . $invoice->invoicesId;

		$data['invoicesId'] = $invoice['invoicesId'];
		$attachments = array(
			array("file" => $invoice['pdf_path'], "filename" => "Php-Ninja-" . $invoice['invoicesId'] . ".pdf")
		);

		$mails->sendTemplate('invoice', $data, $invoice['customer']['email'], $subject, $attachments);
	}


	// CREATE & SEND INVOICE
	public function create($invoice)
	{


		$invoice['invoicesId'] = $this->getNextInvoiceId();
		$invoice['cart'] = json_encode($invoice['cart']);

		$invoice['pdf_path'] = $this->pdfName($invoice);


		$consulta = $this->db->prepare("INSERT INTO invoices (invoicesId,period,paymentsId,customersId,cart,subtotal,iva,total,payment_method, pdf_path) VALUES (:invoicesId, extract(YEAR_MONTH FROM CURDATE()) ,:paymentsId,:customersId,:cart,:subtotal,:iva,:total,:payment_method, :pdf_path)");


		$consulta->bindParam(":invoicesId", $invoice['invoicesId']);
		$consulta->bindParam(":paymentsId", $invoice['paymentsId']);
		$consulta->bindParam(":customersId", $invoice['customersId']);
		$consulta->bindParam(":cart", $invoice['cart']);
		$consulta->bindParam(":subtotal", $invoice['subtotal']);
		$consulta->bindParam(":iva", $invoice['iva']);
		$consulta->bindParam(":total", $invoice['total']);
		$consulta->bindParam(":payment_method", $invoice['payment_method']);
		$consulta->bindParam(":pdf_path", $invoice['pdf_path']);

		if ($consulta->execute()) {
			$this->pdf($invoice['invoicesId']);
			# TO-DO: SEND INVOICE EMAIL
			return $invoice;
		} else {
			return array();
		}
	}
	private function pdfName($invoice)
	{

		return  $invoice['invoicesId'] . ".pdf";
	}
	public function pdf($invoiceId)
	{

		$invoice = $this->getByInvoicesId($invoiceId);
		$filename = $this->pdfName($invoice);



		ob_start();
		include ROOT_PATH . "app/pdfs/invoice.php";
		$html = ob_get_clean();

		// instantiate and use the dompdf class
		$dompdf = new Dompdf();
		$dompdf->loadHtml($html);

		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'portrait');

		// Render the HTML as PDF
		$dompdf->render();

		// Output the generated PDF to Browser

		$output = $dompdf->output();



		if (file_put_contents(APP_UPLOAD_PATH . "invoices/" . $filename, $output)) {

			return	 APP_UPLOAD_PATH . "invoices/" . $filename;
		}
		return "Error";
	}
}
