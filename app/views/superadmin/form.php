<header class="py-6 border-gray-600  bg-gray-800">
	<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 ">
		<h1 class="text-3xl font-bold tracking-tight text-gray-100"><? if ($rid != -1) {
																		echo ucfirst($table_label) . ' #' . $rid; ?>
				<!-- Meta data -->
				<small class="text-xs text-gray-400 block font-italic"></small>
			<? } else echo ucfirst($table) . ' ➞ Add New '; ?>
		</h1>
		<? if ($rid != -1): ?>
			<p class="text-base leading-8 text-gray-300"> Created <?= strftime(" %d %B %Y %H:%M", strtotime($raw['created'])) ?> - Updated: <?= strftime(" %d %B %Y %H:%M", strtotime($raw['updated'])) ?></p>
		<? endif; ?>
	</div>
</header>

<div class="flex min-h-screen flex-col bg-gray-800">
	<div class="mx-auto flex w-full max-w-7xl items-start gap-x-8 px-4 py-10 sm:px-6 lg:px-8">
		<!-- SIDEBAR -->
		<? include_once dirname(__FILE__) . "/../layout/sidebar-private.php"; ?>
		<main class="flex-1 text-gray-800">
			<div class=" main max-w-2xl mx-auto bg-white rounded-lg px-6 py-5 mb-10">
				<!-- Notification -->
				<form class='form  py-3' id="form<?= $table ?><?= $rid ?>" name="<?= APP_BASE_URL ?>form<?= $table ?><?= $rid ?>" action="update" method="POST" enctype="multipart/form-data">

					<nav class="flex items-center justify-between space-x-2" aria-label="Breadcrumb">
						<a href="<?= APP_DOMAIN ?>table/<?= $table ?>" class="flex justify-start text-gray-500 hover:font-bold hover:text-gray-500 hover:bg-gray-100 rounded-full px-3">
							<ol role="list" class="flex space-x-3 ">
								<li class="flex">
									<div class="flex items-center">

										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
											<path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
										</svg>


									</div>
								</li>
								<li class="flex">
									<div class="flex text-lg items-center">

										Back
									</div>
								</li>


							</ol>
						</a>
						<button class='flex items-center justify-end px-4 py-1 border border-transparent text-base font-medium rounded-full shadow-sm text-white bg-orange-500 hover:bg-orange-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900' onclick="check_form_values(this.form);" type="submit"><i class="glyphicon glyphicon-ok"></i> Save <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
								<path stroke-linecap="round" stroke-linejoin="round" d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
							</svg>
						</button>
					</nav>

					<? if (isset($_GET['i']) and $_GET['i'] == 'success'): ?>
						<div class="alert alert-success">
							<a class="close" data-dismiss='alert'>&times;</a>
							<strong>OK</strong> <?= $notification ?>
						</div>
					<? endif; ?>






					<fieldset>
						<?= $form ?>
						<input type="hidden" name="table" value="<?= $table ?>">
						<input type="hidden" name="op" value='<?= $op ?>'>
						<input type="hidden" name="return_url" value='<?= isset($_SESSION['return_url']) ? $_SESSION['return_url'] : ''  ?>'>
						<input type="hidden" name="rid" value="<?= $rid ?>">
						<hr>

						&nbsp;&nbsp;
						<!-- <button class='inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-orange-500 hover:bg-orange-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900' onclick="check_form_values(this.form);" type="button"><i class="glyphicon glyphicon-ok"></i> Guardar</button> -->
					</fieldset>

				</form>

			</div>

	</div> <!-- End Grid -->


</div> <!-- End main -->



</main>
</div>