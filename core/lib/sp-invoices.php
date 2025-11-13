<?php

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

	var $table = 'invoices';
	public function __construct()
	{
		parent::__construct($this->table);
	}
	/**
	 * getById
	 *
	 * @param  int $id
	 * @return void
	 */
	public function getById($id)
	{
		$consulta = $this->db->prepare("SELECT *, invoices.created as created, invoices.iva as iva FROM invoices JOIN accounts on (invoices.accountsId = accounts.accountsId) where invoicesId=:id ");
		$consulta->bindParam(":id", $id);
		$consulta->execute();
		return $consulta->fetch();
	}

	/**
	 * getByAccountsId
	 *
	 * @param  int $id
	 * @return void
	 */
	public function getByAccountsId($id)
	{

		$consulta = $this->db->prepare("SELECT * FROM invoices where accountsId=:id ");
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

		$invoice = $this->getById($invoiceId);
		$filename = $this->pdfName($invoice);



		ob_start();
		include ROOT_PATH . "pdfs/invoice.php";
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

		if (!is_dir(APP_UPLOAD_PATH . "invoices/")) {
			mkdir(APP_UPLOAD_PATH . "invoices/", 0777, true);
		}


		if (file_put_contents(APP_UPLOAD_PATH . "invoices/" . $filename, $output)) {

			return	 LANDING_URL . "uploads/invoices/" . $filename;
		}
		return "Error";
	}


	/* ================== HELPERS BÁSICOS ================== */

	private function sif_uuid(): string
	{
		return bin2hex(random_bytes(16)); // 32 hex
	}

	private function nowUTC(): string
	{
		return gmdate('Y-m-d\TH:i:s\Z'); // ISO8601 UTC
	}

	private function normAmount($v): string
	{
		return number_format((float)$v, 2, '.', '');
	}

	private function normDate($v): string
	{
		if (preg_match('/^\d{4}-\d{2}-\d{2}$/', (string)$v)) return (string)$v;
		return (new DateTime($v))->format('Y-m-d');
	}

	private function sif_buildPayload(array $inv): array
	{
		return [
			'issuer_vat'    => trim($inv['issuer_vat']    ?? ''),
			'issuer_name'   => trim($inv['issuer_name']   ?? ''),
			'customer_vat'  => trim($inv['customer_vat']  ?? ''),
			'customer_name' => trim($inv['customer_name'] ?? ''),
			'series'        => trim($inv['series']        ?? ''),
			'number'        => (string)($inv['number']    ?? ''),
			'issue_date'    => $this->normDate($inv['issue_date'] ?? date('Y-m-d')),
			'total'         => $this->normAmount($inv['total']      ?? 0),
			'tax_base'      => $this->normAmount($inv['tax_base']   ?? 0),
			'tax_amount'    => $this->normAmount($inv['tax_amount'] ?? 0),
			'currency'      => 'EUR',
		];
	}

	private function sif_canonicalString(array $payload): string
	{
		$order = ['issuer_vat', 'issuer_name', 'customer_vat', 'customer_name', 'series', 'number', 'issue_date', 'total', 'tax_base', 'tax_amount', 'currency'];
		$parts = [];
		foreach ($order as $k) $parts[] = $k . '=' . $payload[$k];
		return implode('|', $parts);
	}

	private function sif_seriesPrevHash(string $series): ?string
	{
		$q = $this->db->prepare("SELECT sif_hash FROM invoices 
                              WHERE series = :s AND sif_hash IS NOT NULL 
                              ORDER BY number DESC LIMIT 1");
		$q->execute([':s' => $series]);
		$r = $q->fetch(PDO::FETCH_ASSOC);
		return $r ? ($r['sif_hash'] ?? null) : null;
	}

	private function sif_hash(array $inv, ?string $prevHash): string
	{
		$canon = $this->sif_canonicalString($this->sif_buildPayload($inv));
		return hash('sha256', ($prevHash ?? '') . '#' . $canon);
	}

	private function sif_sign(string $hash): ?string
	{
		// Firma opcional: busca clave en APP_UPLOAD_PATH/keys/sif_private.pem
		$keyPath = (defined('APP_UPLOAD_PATH') ? APP_UPLOAD_PATH : __DIR__ . '/') . 'keys/sif_private.pem';
		if (!file_exists($keyPath)) return null;
		$priv = openssl_pkey_get_private('file://' . $keyPath, getenv('SIF_KEY_PASS') ?: null);
		if (!$priv) return null;
		$signature = '';
		if (openssl_sign($hash, $signature, $priv, OPENSSL_ALGO_SHA256)) {
			return base64_encode($signature);
		}
		return null;
	}

	private function sif_qrLegend(string $mode): string
	{
		if ($mode === 'verifactu') {
			return "Factura emitida por Sistema de Facturación con envío Veri*factu a AEAT.\nConsulte el código QR para verificación.";
		}
		return "Factura emitida por Sistema de Facturación conforme a SIF (no Veri*factu).\nConsulte el código QR para verificación interna.";
	}

	/* --- QR: usa REAL si tienes chillerlan/php-qrcode; si no, placeholder SVG --- */
	private function sif_qrDataUri(string $payload): string
	{
		/* ==== QR REAL (descomentar si instalas la lib) ====
    $opt = new QROptions([
      'outputType' => QRCode::OUTPUT_IMAGE_PNG,
      'scale' => 4,
      'quietzone' => 1,
    ]);
    $data = (new QRCode($opt))->render($payload);
    return 'data:image/png;base64,'.base64_encode($data);
    */
		// Placeholder (SVG)
		$svg = '<svg xmlns="http://www.w3.org/2000/svg" width="120" height="120"><rect width="120" height="120" fill="#fff"/><text x="8" y="64" font-size="10" fill="#000">QR</text></svg>';
		return 'data:image/svg+xml;base64,' . base64_encode($svg);
	}

	private function sif_eventAdd(int $invoiceId, string $type, array $payload = []): void
	{
		$prev = $this->db->prepare("SELECT event_hash FROM invoice_events WHERE invoice_id = :id ORDER BY id DESC LIMIT 1");
		$prev->execute([':id' => $invoiceId]);
		$row = $prev->fetch(PDO::FETCH_ASSOC);
		$prevHash = $row ? ($row['event_hash'] ?? null) : null;

		$canon = json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
		$hash  = hash('sha256', ($prevHash ?? '') . '#' . $canon);
		$sig   = $this->sif_sign($hash);

		$ins = $this->db->prepare("INSERT INTO invoice_events 
      (invoice_id,event_type,event_payload,event_prev_hash,event_hash,event_signature,created_at)
      VALUES (:i,:t,:p,:ph,:h,:s,:ts)");
		$ins->execute([
			':i' => $invoiceId,
			':t' => $type,
			':p' => $canon,
			':ph' => $prevHash,
			':h' => $hash,
			':s' => $sig,
			':ts' => $this->nowUTC()
		]);
	}

	/* ================== FLUJOS SIF ================== */

	public function sif_emitirAlta(int $invoiceId, string $mode = 'no_verifactu'): bool
	{
		// 1) Cargar factura
		$q = $this->db->prepare("SELECT * FROM invoices WHERE invoicesId=:id");
		$q->execute([':id' => $invoiceId]);
		$inv = $q->fetch(PDO::FETCH_ASSOC);
		if (!$inv) return false;

		// 2) prev_hash por serie
		$prevHash = $this->sif_seriesPrevHash($inv['series'] ?? '');

		// 3) Calcular hash, firma, QR, leyenda
		$uuid  = $this->sif_uuid();
		$hash  = $this->sif_hash($inv, $prevHash);
		$sig   = $this->sif_sign($hash);

		$qrPayload = json_encode([
			'uuid'   => $uuid,
			'series' => $inv['series'] ?? '',
			'number' => $inv['number'] ?? '',
			'date'   => $inv['issue_date'] ?? '',
			'total'  => $inv['total'] ?? '',
			'mode'   => $mode,
			'hash'   => $hash
		], JSON_UNESCAPED_SLASHES);

		$qrDatauri = $this->sif_qrDataUri($qrPayload);
		$legend    = $this->sif_qrLegend($mode);

		// 4) Persistir
		$u = $this->db->prepare("UPDATE invoices SET
      sif_mode=:m, sif_uuid=:u, sif_prev_hash=:ph, sif_hash=:h, sif_signature=:sg,
      sif_qr_payload=:qp, sif_qr_datauri=:qd, sif_legend=:lg, sif_send_status='pending'
      WHERE invoicesId=:id");
		$u->execute([
			':m' => $mode,
			':u' => $uuid,
			':ph' => $prevHash,
			':h' => $hash,
			':sg' => $sig,
			':qp' => $qrPayload,
			':qd' => $qrDatauri,
			':lg' => $legend,
			':id' => $invoiceId
		]);

		// 5) Evento ALTA
		$this->sif_eventAdd($invoiceId, 'alta', ['mode' => $mode, 'hash' => $hash]);
		return true;
	}

	public function sif_anular(int $originalInvoiceId, int $cancelInvoiceId, string $reason = ''): bool
	{
		$ins = $this->db->prepare("INSERT INTO invoice_cancel_links (original_invoice_id,cancel_invoice_id,reason) VALUES (:o,:c,:r)");
		$ins->execute([':o' => $originalInvoiceId, ':c' => $cancelInvoiceId, ':r' => $reason]);
		$this->sif_eventAdd($cancelInvoiceId, 'anulacion', ['original' => $originalInvoiceId, 'reason' => $reason]);
		return true;
	}

	public function sif_exportarPeriodo(string $fromDate, string $toDate): array
	{
		$q = $this->db->prepare("SELECT * FROM invoices WHERE issue_date BETWEEN :f AND :t ORDER BY series ASC, number ASC");
		$q->execute([':f' => $fromDate, ':t' => $toDate]);
		$rows = $q->fetchAll(PDO::FETCH_ASSOC);

		$payload = json_encode(['from' => $fromDate, 'to' => $toDate, 'invoices' => $rows], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
		$checksum = hash('sha256', $payload);

		// Registrar evento export
		foreach ($rows as $r) {
			if (!empty($r['invoicesId'])) {
				$this->sif_eventAdd((int)$r['invoicesId'], 'export', ['from' => $fromDate, 'to' => $toDate, 'checksum' => $checksum]);
			}
		}
		return ['payload' => $payload, 'checksum' => $checksum];
	}

	public function sif_marcarExportadas(array $invoiceIds, string $checksum): void
	{
		$u = $this->db->prepare("UPDATE invoices SET sif_export_checksum=:c WHERE invoicesId=:id");
		foreach ($invoiceIds as $id) $u->execute([':c' => $checksum, ':id' => $id]);
	}

	public function sif_outboxEncolar(int $invoiceId, string $payload): void
	{
		$ins = $this->db->prepare("INSERT INTO sif_outbox (invoice_id,payload,status) VALUES (:i,:p,'pending')");
		$ins->execute([':i' => $invoiceId, ':p' => $payload]);
		$this->sif_eventAdd($invoiceId, 'send', ['queued' => true]);
	}

	public function sif_outboxProcesar(): int
	{
		$q = $this->db->query("SELECT * FROM sif_outbox WHERE status='pending' ORDER BY id ASC LIMIT 50");
		$n = 0;
		while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
			$n++;
			// Aquí integrarías el cliente real de AEAT; de momento simula OK:
			$ok = true;
			$receipt = 'ACK-' . $row['id'];

			$upd = $this->db->prepare("UPDATE sif_outbox SET status=:s, try_count=COALESCE(try_count,0)+1, last_try_at=:ts WHERE id=:id");
			$upd->execute([':s' => $ok ? 'ok' : 'error', ':ts' => $this->nowUTC(), ':id' => $row['id']]);

			$u2 = $this->db->prepare("UPDATE invoices SET sif_send_status=:s, sif_sent_at=:ts, sif_aeat_receipt=:r WHERE invoicesId=:id");
			$u2->execute([
				':s' => $ok ? 'ok' : 'error',
				':ts' => $this->nowUTC(),
				':r' => $ok ? $receipt : null,
				':id' => $row['invoice_id']
			]);

			$this->sif_eventAdd((int)$row['invoice_id'], $ok ? 'recv' : 'error', ['outbox_id' => $row['id'], 'receipt' => $receipt]);
		}
		return $n;
	}

	/* ================== PDF (hash del PDF y evento print) ================== */

	public function storePdfHashEvent(int $invoiceId, string $pdfBinary, string $filePath): void
	{
		if (!is_dir(dirname($filePath))) @mkdir(dirname($filePath), 0775, true);
		file_put_contents($filePath, $pdfBinary);

		$pdfSha = hash('sha256', $pdfBinary);
		$u = $this->db->prepare("UPDATE invoices SET sif_pdf_sha256=:h WHERE invoicesId=:id");
		$u->execute([':h' => $pdfSha, ':id' => $invoiceId]);

		$this->sif_eventAdd($invoiceId, 'print', ['pdf_path' => $filePath, 'pdf_sha256' => $pdfSha]);
	}

	/* ================== ENDPOINTS (endpoint_metodo) ================== */

	public function endpoint_sif_emitir()
	{
		$invoiceId = (int)($_REQUEST['invoice_id'] ?? 0);
		$mode = $_REQUEST['mode'] ?? 'no_verifactu';
		$ok = $this->sif_emitirAlta($invoiceId, $mode);
		return ['ok' => $ok, 'invoice_id' => $invoiceId];
	}

	public function endpoint_sif_anular()
	{
		$originalId = (int)($_REQUEST['original_id'] ?? 0);
		$cancelId   = (int)($_REQUEST['cancel_id'] ?? 0);
		$reason     = (string)($_REQUEST['reason'] ?? '');
		$ok = $this->sif_anular($originalId, $cancelId, $reason);
		return ['ok' => $ok, 'original' => $originalId, 'cancel' => $cancelId];
	}

	public function endpoint_sif_exportar()
	{
		$from = $_REQUEST['from'] ?? date('Y-m-01');
		$to   = $_REQUEST['to']   ?? date('Y-m-t');
		$res  = $this->sif_exportarPeriodo($from, $to);
		$fname = (defined('APP_UPLOAD_PATH') ? APP_UPLOAD_PATH : __DIR__ . '/') . 'exports/verifactu_' . $from . '_' . $to . '.json';
		if (!is_dir(dirname($fname))) @mkdir(dirname($fname), 0775, true);
		file_put_contents($fname, $res['payload']);
		return ['ok' => true, 'file' => $fname, 'checksum' => $res['checksum']];
	}

	public function endpoint_sif_marcar_exportadas()
	{
		$ids = isset($_REQUEST['ids']) ? (array)$_REQUEST['ids'] : [];
		$checksum = (string)($_REQUEST['checksum'] ?? '');
		$this->sif_marcarExportadas(array_map('intval', $ids), $checksum);
		return ['ok' => true, 'count' => count($ids)];
	}

	public function endpoint_sif_enqueue()
	{
		$invoiceId = (int)($_REQUEST['invoice_id'] ?? 0);
		$payload = json_encode(['invoice_id' => $invoiceId, 'ts' => $this->nowUTC()]);
		$this->sif_outboxEncolar($invoiceId, $payload);
		return ['ok' => true, 'invoice_id' => $invoiceId];
	}

	public function endpoint_sif_outbox_procesar()
	{
		$n = $this->sif_outboxProcesar();
		return ['ok' => true, 'processed' => $n];
	}
}
