<header class="py-6 border-gray-600  bg-gray-900">
	<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 ">
		<h1 class="text-3xl font-bold tracking-tight text-gray-100">Dashboard</h1>
		<p class="text-base leading-8 text-gray-300">You are signed up as "<?= $_SESSION['user']['group'] ?>" - Only registered users can see this</p>
	</div>
</header>



<div class="flex min-h-screen flex-col bg-gray-800">


	<div class="mx-auto flex w-full max-w-7xl items-start gap-x-8 px-4 py-10 sm:px-6 lg:px-8">
		<? include_once dirname(__FILE__) . "/../layout/sidebar-private.php"; ?>


		<main class="flex-1 text-gray-100">
			<div class="mx-auto text-center mb-10">


				<h2 class="text-3xl"><? if ($rid != -1) {
											echo ucfirst($table_label) . ' #' . $rid; ?>
						<!-- Meta data -->
						<small class="text-xs text-gray-400 block font-italic"> Creado <?= strftime(" %d %B %Y %H:%M", strtotime($raw['created'])) ?><br> Actualizado <?= strftime(" %d %B %Y %H:%M", strtotime($raw['updated'])) ?></small>
					<? } else echo ucfirst($table) . ' > Añadir nuevo '; ?>
				</h2>
				<p class="mt-1 text-xs text-gray-400 ">

					Membresía:
					<span class="inline-flex items-center gap-x-1.5 rounded-full bg-orange-100 px-2 py-1 text-xs font-medium text-orange-700">
						<svg class="h-1.5 w-1.5 fill-orange-500" viewBox="0 0 6 6" aria-hidden="true">
							<circle cx="3" cy="3" r="3" />
						</svg>
						Basic (Respuestas en 24-48h)
					</span>


				</p>
				<p>hola@phpninja.es · +34 649 38 29 65</p>




			</div>

			<div class=" main max-w-5xl mx-auto bg-white rounded-lg p-10 mb-10">
				<!-- Notification -->
				<? if (isset($_GET['i']) and $_GET['i'] == 'success'): ?>
					<div class="alert alert-success">
						<a class="close" data-dismiss='alert'>&times;</a>
						<strong>OK</strong> <?= $notification ?>
					</div>
				<? endif; ?>

				<div class="<? if ($rid != -1): echo 'xlg:grid xlg:grid-cols-10 xgap-4';
							endif; ?> ">
					<? $width = $rid === -1 ? 'xcol-span-4' : 'xcol-span-4'; ?>

					<!-- COL 1: Left -->
					<div class="<? echo $width; ?> " style="margin-left:0px;padding-left:0px;">
						<div>

						</div>
						<? if ($table == "customers"): ?>

							<? //include "staff/component-webinfo-customer.php"; 
							?>
							<? include "staff/component-customer.php"; ?>

							<? // include "staff/component-activity.php"; 
							?>
							<? // include "staff/component-stripe-link.php"; 
							?>
						<? endif; ?>
						<form class='form  py-3' id="form<?= $table ?><?= $rid ?>" name="<?= APP_BASE_URL ?>form<?= $table ?><?= $rid ?>" action="update" method="POST" enctype="multipart/form-data">
							<div class="">
								<button class='inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-orange-500 hover:bg-orange-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900' onclick="check_form_values(this.form);" type="button"><i class="glyphicon glyphicon-ok"></i> Guardar</button><br><br>
								<fieldset>
									<?= $form ?>
									<input type="hidden" name="table" value="<?= $table ?>">
									<input type="hidden" name="op" value='<?= $op ?>'>
									<input type="hidden" name="return_url" value='<?= isset($_SESSION['return_url']) ? $_SESSION['return_url'] : ''  ?>'>
									<input type="hidden" name="rid" value="<?= $rid ?>">
									<hr>

									&nbsp;&nbsp;
									<button class='inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-orange-500 hover:bg-orange-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900' onclick="check_form_values(this.form);" type="button"><i class="glyphicon glyphicon-ok"></i> Guardar</button>
								</fieldset>
							</div>
						</form>
					</div>

					<!-- COL 2 -->
					<div class="xcol-span-1">


						<? if ($table == "comments" and $rid > -1): ?>
							<? include "staff/component-comments.php"; ?>
						<? endif; ?>
						<? if ($table == "documentos" and $rid > -1): ?>
							<a class="btn btn-warning" href="/makePdf/<?= $rid ?>">Descargar PDF</a>
						<? endif; ?>
						<? if ($table == "spams" and $rid > -1): ?>
							<a class="btn btn-warning" href="/sendSpam/<?= $rid ?>">¡Enviar SPAM!</a>
						<? endif; ?>

						<? if ($table == "tickets" and $rid > -1): ?>
							<?	//include "staff/component-ticket.php"; 
							?>
							<?	//	 include "staff/component-comments.php";  
							?>
						<? endif; ?>

						<?
						if ($rid != -1 and $table !== "customers" and $table !== "leads" and $table !== "comments") {
						} else if ($rid != -1) {
							if ($table == "customers"):
								if ($raw['iva'] == 0): ?> Ojito! <strong>Cliente con IVA desactivado</strong> <? endif;
																						//include "staff/component-new-ticket.php"; 
																						//include "staff/component-mails.php"; 
																						endif;
																					}
																								?>

					</div>

					<!-- COL 3: Right -->
					<div class="col-span-4">
						<?
						if ($rid != -1):

							if ($table == "tickets"): ?>
								<? //include "staff/component-ticketsinfo.php"; 
								?>
								<? //include "staff/component-openai.php"; 
								?>
								<? include "staff/component-webinfo.php"; ?>
								<? include "staff/component-credentials.php"; ?>
								<? include "staff/component-attachments.php"; ?>
								<? include "staff/component-changelog.php"; ?>
								<? include "staff/component-tickets.php"; ?>

								<? //include "staff/component-timetables.php"; 
								?>
								<? //include "staff/component-comments.php"; 
								?>
							<? endif; ?>
							<? if ($table == "webs"): ?>

								<? include "staff/component-webinfo.php"; ?>
								<? include "staff/component-credentials.php"; ?>
								<? include "staff/component-attachments.php"; ?>
								<? include "staff/component-weblogs.php"; ?>

								<? include "staff/component-web-mantenimiento.php"; ?>
							<? endif; ?>
						<? endif; ?>
					</div>

				</div> <!-- End Grid -->


			</div> <!-- End main -->



		</main>
	</div>