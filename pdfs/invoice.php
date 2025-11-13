invoice.php — Template PDF minimal con VERI*FACTU *invoice.php — Template PDF minimal con VERI*FACTU *invoice.php — Template PDF minimal con VERI*FACTU *invoice.php — Template PDF minimal con VERI*FACTU *invoice.php — Template PDF minimal con VERI*FACTU *invoice.php — Template PDF minimal con VERI*FACTU *invoice.php — Template PDF minimal con VERI*FACTU *invoice.php — Template PDF minimal con VERI*FACTU *invoice.php — Template PDF minimal con VERI*FACTU *invoice.php — Template PDF minimal con VERI*FACTU *invoice.php — Template PDF minimal con VERI*FACTU *invoice.php — Template PDF minimal con VERI*FACTU *invoice.php — Template PDF minimal con VERI*FACTU *<?php
																																																																																																																																																																						/** invoice.php — Template PDF minimal con VERI*FACTU **/

																																																																																																																																																																						/** @var array $invoice */
																																																																																																																																																																						$data = $invoice;

																																																																																																																																																																						/* Helpers de escape */
																																																																																																																																																																						function e($v)
																																																																																																																																																																						{
																																																																																																																																																																							return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
																																																																																																																																																																						}
																																																																																																																																																																						?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<title>Factura <?= e($data['series']) ?>-<?= e($data['number']) ?></title>
	<style>
		body {
			font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
			color: #111827;
			font-size: 12px;
		}

		.wrap {
			width: 100%;
		}

		.row {
			display: flex;
			justify-content: space-between;
			align-items: flex-start;
			gap: 12px;
		}

		.box {
			border: 1px solid #e5e7eb;
			border-radius: 8px;
			padding: 12px;
		}

		.muted {
			color: #6b7280;
		}

		.title {
			font-size: 18px;
			font-weight: 700;
		}

		.h {
			font-size: 14px;
			font-weight: 600;
			margin: 0 0 6px;
		}

		table {
			width: 100%;
			border-collapse: collapse;
		}

		th,
		td {
			padding: 6px 8px;
			border-bottom: 1px solid #e5e7eb;
			text-align: left;
		}

		.right {
			text-align: right;
		}

		.sif-box {
			border: 1px solid #e5e7eb;
			border-radius: 8px;
			padding: 10px;
			margin-top: 10px;
		}

		.sif-flex {
			display: flex;
			gap: 12px;
			align-items: center;
		}

		.sif-qr {
			width: 120px;
			height: 120px;
			object-fit: contain;
			border: 1px solid #eee;
			padding: 4px;
			background: #fff;
		}

		.sif-legend {
			font-size: 12px;
			color: #374151;
			line-height: 1.4;
			white-space: pre-line;
		}

		.sif-meta {
			font-size: 11px;
			color: #6b7280;
			margin-top: 6px;
		}

		.foot {
			margin-top: 18px;
			font-size: 11px;
			color: #6b7280;
		}
	</style>
</head>

<body>
	<div class="wrap">

		<!-- Encabezado -->
		<div class="row">
			<div>
				<div class="title">FACTURA</div>
				<div class="muted">Serie <?= e($data['series']) ?> · Nº <?= e($data['number']) ?></div>
				<div class="muted">Fecha: <?= e($data['issue_date']) ?></div>
			</div>
			<div>
				<div class="h">Emisor</div>
				<div><?= e($data['issuer_name'] ?? '') ?></div>
				<div class="muted"><?= e($data['issuer_vat'] ?? '') ?></div>
				<div class="muted"><?= e($data['issuer_address'] ?? '') ?></div>
			</div>
			<div>
				<div class="h">Cliente</div>
				<div><?= e($data['customer_name'] ?? '') ?></div>
				<div class="muted"><?= e($data['customer_vat'] ?? '') ?></div>
				<div class="muted"><?= e($data['customer_address'] ?? '') ?></div>
			</div>
		</div>

		<!-- Bloque VERI*FACTU -->
		<?php if (!empty($data['sif_qr_datauri']) || !empty($data['sif_legend'])): ?>
			<div class="sif-box">
				<div class="sif-flex">
					<?php if (!empty($data['sif_qr_datauri'])): ?>
						<img class="sif-qr" src="<?= e($data['sif_qr_datauri']) ?>" alt="QR VERI*FACTU">
					<?php endif; ?>
					<div>
						<?php if (!empty($data['sif_legend'])): ?>
							<div class="sif-legend"><?= e($data['sif_legend']) ?></div>
						<?php endif; ?>
						<div class="sif-meta">
							<?php if (!empty($data['sif_mode'])): ?>Modo SIF: <strong><?= e($data['sif_mode']) ?></strong> · <?php endif; ?>
						<?php if (!empty($data['sif_send_status'])): ?>Estado: <strong><?= e($data['sif_send_status']) ?></strong><?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<!-- Líneas -->
		<div class="box" style="margin-top:12px;">
			<div class="h">Detalle</div>
			<table>
				<thead>
					<tr>
						<th>Concepto</th>
						<th class="right">Cant.</th>
						<th class="right">P. Unit.</th>
						<th class="right">Importe</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach (($data['lines'] ?? []) as $ln): ?>
						<tr>
							<td><?= e($ln['description'] ?? '') ?></td>
							<td class="right"><?= e($ln['qty'] ?? '1') ?></td>
							<td class="right"><?= e(number_format((float)($ln['unit_price'] ?? 0), 2, '.', '')) ?></td>
							<td class="right"><?= e(number_format((float)($ln['total'] ?? 0), 2, '.', '')) ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="3" class="right">Base imponible</td>
						<td class="right"><?= e(number_format((float)($data['tax_base'] ?? 0), 2, '.', '')) ?></td>
					</tr>
					<tr>
						<td colspan="3" class="right">IVA</td>
						<td class="right"><?= e(number_format((float)($data['tax_amount'] ?? 0), 2, '.', '')) ?></td>
					</tr>
					<tr>
						<td colspan="3" class="right"><strong>Total</strong></td>
						<td class="right"><strong><?= e(number_format((float)($data['total'] ?? 0), 2, '.', '')) ?> <?= e($data['currency'] ?? 'EUR') ?></strong></td>
					</tr>
				</tfoot>
			</table>
		</div>

		<!-- Pie -->
		<div class="foot">
			<?php if (!empty($data['sif_pdf_sha256'])): ?>
				Hash PDF: <?= e($data['sif_pdf_sha256']) ?>
			<?php endif; ?>
		</div>

	</div>
</body>

</html>