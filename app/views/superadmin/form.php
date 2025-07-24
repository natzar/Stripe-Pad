<? include "app/views/layout/page_header.php"; ?>


<form id="orm_form" class='form  py-3' id="form<?= $table ?><?= $rid ?>" name="<?= APP_BASE_URL ?>form<?= $table ?><?= $rid ?>" action="update" method="POST" enctype="multipart/form-data">

	<nav class=" items-center justify-between space-x-2 mb-5">

		<button id="submit1" class="items-center  rounded-full bg-blue-600 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" onclick="check_form_values(this.form);" type="submit"><i class="glyphicon glyphicon-ok"></i> <?= _('Guardar Cambios') ?>
		</button>


	</nav>
	<!-- <hr>-->






	<fieldset>
		<div class="grid grid-cols-1 md:grid-cols-2 gap-1 gap-x-6 mt-5">
			<?= $form ?>
		</div>
		<div>


			<input type="hidden" name="table" value="<?= $table ?>">
			<input type="hidden" name="op" value='<?= $op ?>'>
			<input type="hidden" name="return_url" value='<?= isset($_SESSION['return_url']) ? $_SESSION['return_url'] : ''  ?>'>
			<input type="hidden" name="rid" value="<?= $rid ?>">
		</div>
		<div>
&nbsp;&nbsp;
<!-- <button class='inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-500 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900' onclick="check_form_values(this.form);" type="button"><i class="glyphicon glyphicon-ok"></i> Guardar</button> -->



</form>