<?php

$data = $invoice;


?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<title></title>

		<!-- Favicon -->
		<link rel="icon" href="./images/favicon.png" type="image/x-icon" />

		<!-- Invoice styling -->
		<style>
			body {
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				text-align: center;
				color: #777;
			}

			body h1 {
				font-weight: 300;
				margin-bottom: 0px;
				padding-bottom: 0px;
				color: #000;
			}

			body h3 {
				font-weight: 300;
				margin-top: 10px;
				margin-bottom: 20px;
				font-style: italic;
				color: #555;
			}

			body a {
				color: #06f;
			}

			.invoice-box {
				
				margin: auto;
				padding: 30px;
				
		
				font-size: 14px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
				border-collapse: collapse;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2),			.invoice-box table tr td:nth-child(3) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(3) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}
		</style>
	</head>

	<body>
	
		<div class="invoice-box">
			<table>
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="font-style:bold"><br>
									FACTURA<br>

									
								</td>

								<td><br>
									Número Factura #: <?= $data['invoicesId'] ?><br />
									Fecha: <?=date('d/m/Y', strtotime($data['created'])) ?><br />
									<!-- Estado: <?= $data['paid'] ?> -->
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td><img src="data:image/jpeg;base64,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" alt="PHP NINJA logo" style="width: 100%; max-width: 50px;float:left;margin-right:15px;margin-bottom:50px" />
									<strong>Ayesa Digital SLU </strong>(Php Ninja)<br />
									Pso de los tilos 25-27 Bajos A<br />
									08034 Barcelona<br>
									NIF: B01732791<br>

								</td>

								<td>
									<strong>Facturar a</strong><br>
									<?= $invoice['name'] ?><br />
									<?= $invoice['address'] ?><br />
									<?= $invoice['nif'] ?><br>
									<?= $invoice['location'] ?>
								</td>
							</tr>
						</table>
					</td>
				</tr>

			<!-- 	<tr class="heading">
					<td>Payment Method</td>

					<td>Check #</td>
				</tr>

				<tr class="details">
					<td>Check</td>

					<td>1000</td>
				</tr> -->
</table>
<table>
				<tr class="heading">
					<td>Concepto</td>
					<td>Cantidad</td>
					<td>Precio</td>
				</tr>
				<? //$total = 0; foreach($data['items'] as $item): ?>
				<tr class="item">
					<td><?
					$cart = json_decode($invoice['cart']);
					print_r($cart);
					//$invoice['cart']?></td>
					<td>1</td>
					<td><?= number_format($invoice['subtotal'],2, ",",".") ?>&euro;</td>
				</tr>
<? // $total += $item['amount']; endforeach; ?>
				
				<tr class="">
					<td></td>
					<td></td>
					<td>Subtotal: <?= number_format($invoice['subtotal'],2, ",",".") ?>&euro;</td>
				</tr>
				<tr class="">
					<td></td>
					<td></td>
					<td>IVA 21%: <?= number_format($invoice['iva'],2, ",",".") ?>&euro;</td>
				</tr>
				<tr class="total">
					<td></td>
					<td></td>
					<td>Total: <?= number_format($invoice['total'],2, ",",".") ?>&euro;</td>
				</tr>
			</table>
			<br><br>
			<small>Gracias por confiar en Php Ninja / phpninja.es/google-reviews ⭐️ 4,8 / 5 Google Reviews <br>
hola@phpninja.es	/		+34 649 38 29 65 / www.phpninja.es</small>
		</div>
	</body>
</html>

