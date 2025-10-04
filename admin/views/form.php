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
			<? if ($table == 'scenarios'):  ?>
				<!-- <div class=" w-full max-w-3xl">
					<label class="form-label text-lg font-semibold text-gray-600">Opciones Generales</label>

					<table class="w-full text-sm  mb-5">

						<tbody class="divide-y divide-gray-200">

							<tr>
								<td class="text-center"><input type="checkbox" name="dupli_no_reply" class="form-checkbox"></td>
								<td class="p-3">⛔<c>NO RESPONDER</c>. Por defecto, se responden todos los emails recibidos. Si no quieres que se respondan los correos que coincidan con este escenario, marca esta opción</td>
							</tr>

						</tbody>
					</table>



					<label class="form-label text-lg font-semibold text-gray-600"><?php echo _('Notificaciones'); ?></label>
					<p class="mb-4 text-sm text-gray-600"><?php echo _('Recibe una notificación en caso de que se hayan conseguido todos los campos requeridos del escenario'); ?></p>

					<table class="w-full text-sm">

						<tbody class="divide-y divide-gray-200">
							<tr>
								<td class="text-center"><input type="checkbox" name="dupli_send_resumen" class="form-checkbox"></td>
								<td class="p-3">Recibir resumen del correo (con los datos completos)</td>
							</tr>
							<tr>
								<td class="text-center"><input type="checkbox" name="dupli_resend" class="form-checkbox"></td>
								<td class="p-3">Recibir el email completo</td>

							</tr>
							<tr>
								<td class="text-center"><input type="checkbox" name="dupli_add_cc" class="form-checkbox"></td>
								<td class="p-3">
									<c>Añadir mi email en CC:</c> al responder
								</td>
							</tr>
							<tr>
								<td class="text-center"><input type="checkbox" name="dupli_send_sms" class="form-checkbox"></td>
								<td class="p-3">Recibir notificación por SMS (0,10€/msg)</td>

							</tr>



						</tbody>
					</table>
					<hr>

					<a href="<?= APP_DOMAIN ?>profile" class="text-sm block  py-4 text-blue-500 hover:underline">&raquo; <?= _('Configurar preferencias de usuario'); ?></a>

				</div>

				<label class="mt-4 block form-label text-base font-semibold text-gray-600"><?php echo _('Acciones Escenario Completado'); ?></label>
				<p class="mb-4 text-sm text-gray-600"><?php echo _('Acciones a realizar en caso de que se consigan los datos requeridos y se complete el escenario de forma exitosa'); ?></p>
				<div id="llista-accions" class="space-y-4 mb-6">
					<button type="button" class="relative block w-full rounded-lg border-2 border-dashed border-gray-300 p-12 text-center hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
						<svg class="mx-auto size-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v20c0 4.418 7.163 8 16 8 1.381 0 2.721-.087 4-.252M8 14c0 4.418 7.163 8 16 8s16-3.582 16-8M8 14c0-4.418 7.163-8 16-8s16 3.582 16 8m0 0v14m0-4c0 4.418-7.163 8-16 8S8 28.418 8 24m32 10v6m0 0v6m0-6h6m-6 0h-6" />
						</svg>
						<span class="mt-2 block text-sm font-semibold text-gray-900">No hay acciones definidas</span>
					</button>

				</div>

				<div class="bg-white p-3 rounded shadow-md w-full max-w-3xl" id="editor-accions">







				<details>
					<summary class="cursor-pointer">Añadir nueva acción </summary>

					
					<form id="accio-form" class="space-y-4">




						<div>
							<label class="block text-sm font-medium text-gray-700"><?php echo _('Tipus d\'acció'); ?></label>
							<select id="tipus-accio" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">


								<option value="add_calendar"><?php echo _('Añadir al calendario'); ?></option>
								<option value="no_reply"><?php echo _('No responder'); ?></option>


								<option value="api_call"><?php echo _('API: Petición GET/POST '); ?></option>
							</select>
						</div>

						<div id="accio-params" class="space-y-4"></div>
			-->
				<!-- <div class="border-t pt-4">
								<h4 class="text-sm font-medium text-gray-700 mb-2">Condicions</h4>
								<div id="condicions-list" class="space-y-2"></div>
								<div class="flex space-x-2 mb-2">
									<input name="condicio_camp" type="text" class="w-1/3 p-2 border rounded" placeholder="camp (ex: email)">
									<select name="condicio_operador" class="w-1/3 p-2 border rounded">
										<option value="existeix">existeix</option>
										<option value="conté">conté</option>
										<option value="no_conté">no conté</option>
										<option value="=">=</option>
										<option value="!=">≠</option>
									</select>
									<input name="condicio_valor" type="text" class="w-1/3 p-2 border rounded" placeholder="valor (opcional)">
									<button type="button" onclick="afegirCondicio()" class="bg-gray-200 px-3 py-1 rounded">+</button>
								</div>
							</div> 

				<div class="text-right">
					<button type="button" onclick="afegirAccio()" class="bg-blue-600 text-white px-4 py-2 rounded"><?php echo _('Añadir acción'); ?></button>
				</div></details> -->



				<!-- <p class="mt-4 text-sm text-gray-600">Conecta con otros servicios para añadir más acciones.<br>
	Ir a <a class="text-blue-500 hover:underline" href="<?= APP_DOMAIN ?>app_integrations">integraciones &raquo;</a>
</p> -->

				<button id="submit2" class="items-center  rounded-full bg-blue-600 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" onclick="check_form_values(this.form);" type="submit"><i class="glyphicon glyphicon-ok"></i> <?= _('Guardar Cambios') ?></button>
	</fieldset>
</form>
</div>

<script>
	// Control opciones de notificacion

	$(document).ready(function() {
		// 1. Sincronizar: hidden → checkbox
		$("input[name^='dupli_']").each(function() {
			var $checkbox = $(this);
			var originalName = $checkbox.attr("name").replace(/^dupli_/, '');
			var $hidden = $("input[type='hidden'][name='" + originalName + "']");
			if ($hidden.length) {
				$checkbox.prop("checked", $hidden.val() === "1");
			}
		});

		// 2. Sincronizar: checkbox → hidden al cambiar
		$("input[name^='dupli_']").on("change", function() {
			var $checkbox = $(this);
			var originalName = $checkbox.attr("name").replace(/^dupli_/, '');
			var $hidden = $("input[type='hidden'][name='" + originalName + "']");
			if ($hidden.length) {
				$hidden.val($checkbox.is(":checked") ? "1" : "0");
			}
		});
	});

	const paramContainer = document.getElementById('accio-params');
	const tipusAccio = document.getElementById('tipus-accio');
	const llista = document.getElementById('llista-accions');
	const accions = [];
	let condicionsActuals = [];



	const templates = {
		no_reply: `
			`,
		add_calendar: `
    <div>
      <label class="block text-sm font-medium text-gray-700">Títol</label>
      <input name="titol" type="text" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700">Data</label>
      <input name="data" type="text" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6" placeholder="{{data_entrada}}">
    </div>
  `,

		api_call: `
    <div>
      <label class="block text-sm font-medium text-gray-700">Endpoint</label>
      <input name="url" type="text" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6" placeholder="https://api.exemple.com/rebre">
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700">Mètode</label>
      <select name="metode" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
        <option value="POST">POST</option>
        <option value="GET">GET</option>
      </select>
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700">Exemple de dades</label>
      <textarea name="dades" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6" rows="4">{
  "camp1": "valor1",
  "camp2": "valor2"
}</textarea>
    </div>
  `
	};

	function updateParams() {
		const tipus = tipusAccio.value;
		paramContainer.innerHTML = templates[tipus] || '';
		condicionsActuals = []; // reset condicions cada vegada
		//	renderCondicions();
	}

	function afegirAccio() {
		const tipus = tipusAccio.value;
		const params = paramContainer.querySelectorAll('[name]');
		const accio = {
			tipus
		};
		params.forEach(el => accio[el.name] = el.value);
		accio.condicions = condicionsActuals;
		condicionsActuals = [];
		accions.push(accio);
		renderAccions();
		updateParams();
	}

	function eliminarAccio(index) {
		accions.splice(index, 1);
		renderAccions();
	}

	function renderAccions() {
		llista.innerHTML = '';
		accions.forEach((accio, index) => {
			const el = document.createElement('div');
			el.className = 'bg-white shadow sm:rounded-lg w-full border rounded flex justify-between items-center';
			el.innerHTML = `
      


								
										<div class="rounded-md bg-gray-50 px-6 py-5 sm:flex sm:items-start sm:justify-between w-full">
											
											<div class="sm:flex sm:items-start">
												<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
</svg>

												<div class="mt-3 sm:ml-4 sm:mt-0">
													
												<div class="text-sm font-medium text-gray-900">${accio.tipus}</div>
													<div class="mt-1 text-sm text-gray-600 sm:flex sm:items-center">
													
														<div class="mt-1 sm:mt-0">${Object.entries(accio).filter(([k]) => k !== 'tipus' && k !== 'condicions').map(([k, v]) => `${k}: ${v}`).join(', ')}
        ${accio.condicions?.length ? `<br><em class='text-xs'>Condicions: ${accio.condicions.length}</em>` : ''}</div>
													</div>
												</div>
											</div>
											<div class="mt-4 sm:ml-6 sm:mt-0  justify-end sm:shrink-0">
												<button onclick="eliminarAccio(${index})" type="button" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">X</button>
											</div>
								
							

    `;
			llista.appendChild(el);
		});
		document.dispatchEvent(new CustomEvent('accionsUpdated', {
			detail: accions
		}));
	}

	document.addEventListener('DOMContentLoaded', () => {
		const saved = document.getElementById('actions');
		if (saved && saved.value) {
			try {
				const carregades = JSON.parse(saved.value);
				carregades.forEach(a => accions.push(a));

				console.log('Loaded saved actions', carregades);
				renderAccions();
			} catch (e) {
				console.warn('Error carregant accions desades', e);
			}
		}
	});

	document.addEventListener('change', () => {
		document.dispatchEvent(new CustomEvent('accionsUpdated', {
			detail: accions
		}));
	});

	tipusAccio.addEventListener('change', updateParams);
	updateParams();

	document.addEventListener('accionsUpdated', e => {
		console.log('Accions actualitzades', e.detail);
		const hidden = document.getElementById('actions');
		if (hidden) hidden.value = JSON.stringify(e.detail);
	});
</script>

<? endif; ?>
&nbsp;&nbsp;
<!-- <button class='inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-500 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900' onclick="check_form_values(this.form);" type="button"><i class="glyphicon glyphicon-ok"></i> Guardar</button> -->



</form>