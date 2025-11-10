<?php
$tracker = $tracker ?? [];
$history = $tracker['history'] ?? [];
$labels = array_column($history, 'label');
$prices = array_map(function ($point) {
	return $point['price'];
}, $history);
$latestPrice = $tracker['price'];
$change = $tracker['change_24h'];
$currencySymbol = $currency === 'USD' ? '$' : ($currency === 'EUR' ? '€' : $currency . ' ');
?>

<header class="pb-6">
	<div class="mx-auto">
		<p class="text-sm font-medium text-indigo-400"><?= _('Sample App') ?></p>
		<h1 class="text-3xl font-bold tracking-tight text-gray-900"><?= _('Bitcoin Price Tracker') ?></h1>
		<p class="mt-2 text-gray-400 max-w-2xl">
			<?= _('This page fetches live market data from CoinGecko (with graceful fallbacks) to showcase how you can wire external APIs into your private app.') ?>
		</p>
	</div>
</header>

<?php if (!empty($tracker['error'])): ?>
	<div class="mb-6 rounded-lg border border-yellow-400 bg-yellow-50 px-4 py-3 text-sm text-yellow-800">
		<?= _('We could not reach the live API right now, so you are seeing demo data. Error:') ?>
		<?= htmlspecialchars($tracker['error'], ENT_QUOTES, 'UTF-8') ?>
	</div>
<?php endif; ?>

<div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
	<div class="rounded-xl bg-white/90 p-5 shadow">
		<p class="text-sm font-medium text-gray-500"><?= _('Current price') ?></p>
		<p class="mt-2 text-3xl font-semibold text-gray-900">
			<?= $latestPrice ? $currencySymbol . number_format($latestPrice, 2) : _('n/a'); ?>
		</p>
	</div>
	<div class="rounded-xl bg-white/90 p-5 shadow">
		<p class="text-sm font-medium text-gray-500"><?= _('24h change') ?></p>
		<?php
		$changeFormatted = $change !== null ? number_format($change, 2) . '%' : _('n/a');
		$changeColor = $change > 0 ? 'text-green-600' : ($change < 0 ? 'text-red-600' : 'text-gray-700');
		?>
		<p class="mt-2 text-3xl font-semibold <?= $changeColor ?>">
			<?= $changeFormatted; ?>
		</p>
	</div>
	<div class="rounded-xl bg-white/90 p-5 shadow">
		<p class="text-sm font-medium text-gray-500"><?= _('Last updated') ?></p>
		<p class="mt-2 text-3xl font-semibold text-gray-900">
			<?= $tracker['last_updated'] ?: _('Just now'); ?>
		</p>
	</div>
	<div class="rounded-xl bg-white/90 p-5 shadow">
		<p class="text-sm font-medium text-gray-500"><?= _('Data source') ?></p>
		<p class="mt-2 text-3xl font-semibold text-gray-900">CoinGecko</p>
	</div>
</div>

<section class="mt-8 rounded-2xl bg-white/95 p-6 shadow">
	<div class="flex items-center justify-between">
		<div>
			<h2 class="text-xl font-semibold text-gray-900"><?= _('Performance (last few days)') ?></h2>
			<p class="text-sm text-gray-500"><?= _('Hover the chart to inspect each datapoint.') ?></p>
		</div>
	</div>
	<canvas id="btcChart" class="mt-6 h-72"></canvas>
	<?php if (!empty($history)): ?>
		<div class="mt-6">
			<h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide"><?= _('Recent closing prices') ?></h3>
			<dl class="mt-3 grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
				<?php foreach (array_slice(array_reverse($history), 0, 4) as $point): ?>
					<div class="rounded-lg border border-gray-200 p-3">
						<dt class="text-xs text-gray-500"><?= $point['label']; ?></dt>
						<dd class="text-lg font-semibold text-gray-900"><?= $currencySymbol . number_format($point['price'], 2); ?></dd>
					</div>
				<?php endforeach; ?>
			</dl>
		</div>
	<?php endif; ?>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js"></script>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		const labels = <?= json_encode($labels); ?>;
		const values = <?= json_encode($prices); ?>;
		const ctx = document.getElementById('btcChart');

		if (!labels.length || !values.length) {
			ctx.classList.add('hidden');
			return;
		}

		new Chart(ctx, {
			type: 'line',
			data: {
				labels: labels,
				datasets: [{
					label: '<?= $currencySymbol ?>',
					data: values,
					borderColor: 'rgb(59, 130, 246)',
					backgroundColor: 'rgba(59, 130, 246, 0.2)',
					borderWidth: 2,
					fill: true,
					tension: 0.3,
					pointRadius: 0
				}]
			},
			options: {
				responsive: true,
				plugins: {
					legend: {
						display: false
					},
					tooltip: {
						mode: 'index',
						intersect: false
					}
				},
				scales: {
					y: {
						beginAtZero: false
					}
				}
			}
		});
	});
</script>