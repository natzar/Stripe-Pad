<div class="mx-auto mb-5">


  <nav class="flex mb-4" aria-label="Breadcrumb">
    <ol role="list" class="flex items-center space-x-4">
      <li>
        <div>
          <a href="<?= ADMIN_URL ?>" class="text-gray-600 hover:text-gray-500">
            <svg class="size-5 shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
              <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 0 1 1.414 0l7 7A1 1 0 0 1 17 11h-1v6a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6H3a1 1 0 0 1-.707-1.707l7-7Z" clip-rule="evenodd" />
            </svg>
            <span class="sr-only">Home</span>
          </a>
        </div>
      </li>
      <li>
        <div class="flex items-center">
          <svg class="size-5 shrink-0 text-gray-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
            <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
          </svg>
          <a href="<?= ADMIN_URL ?>" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"><?= $_SESSION['account']['name'] ?></a>
        </div>
      </li>
      <? if (isset($breadcrumb[0])): ?>
        <li>
          <div class="flex items-center">
            <svg class="size-5 shrink-0 text-gray-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
              <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
            </svg>
            <a href="<?= $breadcrumb[0]['url'] ?>" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"><?= $breadcrumb[0]['label'] ?></a>
          </div>
        </li>
      <? endif; ?>
      <? if (isset($breadcrumb[1])): ?>
        <li>
          <div class="flex items-center">
            <svg class="size-5 shrink-0 text-gray-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
              <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
            </svg>
            <a href="<?= $breadcrumb[1]['url'] ?>" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700" aria-current="page"><?= $breadcrumb[0]['label'] ?></a>
          </div>
        </li>
      <? endif; ?>
      <? if (isset($breadcrumb[2])): ?>
        <li>
          <div class="flex items-center">
            <svg class="size-5 shrink-0 text-gray-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
              <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
            </svg>
            <a href="<?= $breadcrumb[2]['url'] ?>" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700" aria-current="page"><?= $breadcrumb[2]['label'] ?></a>
          </div>
        </li>
      <? endif; ?>
    </ol>
  </nav>


  <div class="flex items-center space-x-4">
    <img src="<?= APP_LOGO ?>" alt="Foto" class="w-12 h-12 rounded-full" />
    <p class="mt-2 text-pretty text-4xl font-semibold tracking-tight text-gray-950 sm:text-4xl"><?= $SEO_TITLE ?></p>

  </div>
  <p class="text-gray-600 mt-2 text-md block max-w-4xl leading-6"><?= $SEO_DESCRIPTION ?></p>

</div>



<div class=" mx-auto ">
  <div class="border-b border-gray-200 mb-6">
    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
      <button data-tab="tab-account" class="tab-btn group inline-flex items-center border-b-2 px-1 py-4 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
        <svg class="-ml-0.5 mr-2 size-5 text-gray-400 group-hover:text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
          <path d="M10 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM3.465 14.493a1.23 1.23 0 0 0 .41 1.412A9.957 9.957 0 0 0 10 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 0 0-13.074.003Z" />
        </svg> <?= _('Datos') ?>
      </button>
      <button data-tab="tab-password" class="tab-btn group inline-flex items-center border-b-2 px-1 py-4 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
        <?= _('Change your password') ?>
      </button>
      <button data-tab="tab-notifications" class="tab-btn group inline-flex items-center border-b-2 px-1 py-4 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
        <?= _('Notificaciones') ?>
      </button>
      <button data-tab="tab-team" class="tab-btn group inline-flex items-center border-b-2 px-1 py-4 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
        <?= _('Acceso y Permisos') ?>
      </button>
    </nav>
  </div>

  <!-- Contenidors de contingut -->
  <div id="tab-account" class="tab-content hidden">


    <!-- My account --->

    <div class="flex min-h-screen flex-col mt-5">


      <div class=" flex  w-full  items-start gap-x-8 ">



        <main class="flex-1 text-gray-700">

          <div class="flex  ">

            <!-- Main Content Column -->
            <div class="w-full  ">
              <div class="col-span-1">

                <div class="">
                  <form action="<?= APP_URL ?>actionUpdateUser" method="POST">
                    <!-- <div class="relative">
                      <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-300"></div>
                      </div>
                      <div class="relative flex justify-start">
                        <span class="bg-white  text-base font-semibold leading-6 text-gray-900"><?= _('Perfil de Usuario') ?></span>
                      </div>
                    </div> -->



                    <div class="mb-4">
                      <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                      <input type="email" name="email" value="<?= $user['email'] ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required="required" disabled="disabled">
                      <p class="text-sm"><?= _('Importante para todas las notificaciones y alertas. Este email no se puede modificar, contacta con ventas si necesitas recibir las notificaciones en otras cuentas de email') ?></p>
                    </div>
                    <div class="mb-4">
                      <label for="name" class="block text-sm font-medium text-gray-700"><?= _('Nombre') ?></label>
                      <input type="text" name="name" value="<?= $user['name'] ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required="required">
                    </div>
                    <!-- <div class="mb-4">
                      <label class="block text-sm font-medium">Teléfono para mensajes SMS / WhatsApp</label>
                      <input type="text" name="notify_phone" value="<? // $secretario['notify_phone'] 
                                                                    ?>" class=" block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                    </div> -->

                    <div class="mb-4">
                      <label for="language" class="block text-sm font-medium text-gray-700"><?= _('Idioma') ?></label>
                      <select id="language" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                        <option value="en">English (US)</option>
                        <option value="es" selected>Spanish (ES)</option>
                        <option value="fr">Française (FR)</option>
                        <!-- Add other languages as needed -->
                      </select>
                    </div>

                    <div class="mb-4">
                      <label for="company" class="block text-sm font-medium text-gray-700"><?= _('Organización') ?></label>
                      <input type="text" name="name" value="<?= $user['name'] ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="mb-4">
                      <label for="address" class="block text-sm font-medium text-gray-700"><?= _('Dirección') ?></label>
                      <input type="text" name="address" value="<?= $user['address'] ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="mb-4">
                      <label for="vat" class="block text-sm font-medium text-gray-700"><?= _('ID / VAT / CIF / NIF (Taxes)') ?></label>
                      <input required="required" type="text" name="nif" value="<?= $user['tax_id'] ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>




                    <input type="submit" class="cursor-pointer rounded-full  bg-gray-100 text-gray-400 hover:bg-sky-800 hover:text-white px-5 py-3 rounded text-sm font-bold" value="<?= _('Update Profile') ?>">

                </div>


                </form>
              </div>



            </div>
            <!-- 
        <a href="/account" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
Listado de Facturas
          </a>
        <table class="min-w-full bg-white">
          <thead>
            <tr>
              <th class="py-2 px-4 border-b">Fecha</th>
              <th class="py-2 px-4 border-b">Número</th>
              <th class="py-2 px-4 border-b">Monto</th>
              <th class="py-2 px-4 border-b">Acción</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="py-2 px-4 border-b">2024-06-14</td>
              <td class="py-2 px-4 border-b">INV-001</td>
              <td class="py-2 px-4 border-b">€500.00</td>
              <td class="py-2 px-4 border-b"><a href="#" class="text-sky-500">Descargar</a></td>
            </tr>
           
          </tbody>
        </table>
 -->



            </div>

          </div>



        </main>

      </div>
    </div>

    <!-- End my account -->
  </div>

  <div id="tab-password" class="tab-content hidden">
    <div class="bg-white p-6 rounded-lg shadow-md mb-5">
      <form action="<?= APP_URL ?>actionUpdateuser" method="POST">
        <div class="relative">
          <div class="absolute inset-0 flex items-center" aria-hidden="true">
            <div class="w-full border-t border-gray-300"></div>
          </div>
          <div class="relative flex justify-start">
            <span class="bg-white text-base font-semibold leading-6 text-gray-900"><?= _('Change your password') ?></span>
          </div>
        </div>

        <div class="mb-4">
          <label for="current_password" class="block text-sm font-medium text-gray-700"><?= _('Current Password') ?></label>
          <input type="password" name="current_password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <div class="mb-4">
          <label for="new_password" class="block text-sm font-medium text-gray-700"><?= _('New Password') ?></label>
          <input type="password" name="new_password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <div class="mb-4">
          <label for="confirm_password" class="block text-sm font-medium text-gray-700"><?= _('Repeat new Password') ?></label>
          <input type="password" name="confirm_password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <input type="submit" class="rounded-full bg-gray-100 text-gray-400 hover:bg-sky-800 hover:text-white px-4 py-2 rounded text-sm font-bold" value="<?= _('Update Password') ?>">
      </form>
    </div>
  </div>

  <div id="tab-notifications" class="tab-content hidden">
    <h2 class="text-xl font-bold mb-3">Notificaciones y Avisos</h2>

    <div class="relative mt-4">
      <div class="absolute inset-0 flex items-center" aria-hidden="true">
        <div class="w-full border-t border-gray-300"></div>
      </div>
      <div class="relative flex justify-start">
        <span class="bg-white  text-base font-semibold leading-6 text-gray-900"><?= _('Resumen de Actividad') ?></span>
      </div>
    </div>


    <input type="checkbox" id="daily_newsletter" name="daily_newsletter" value="1" class="form-checkbox mr-2" checked>
    <span class="text-sm"> Recibir E-mail diario con el resumen de conversaciones mantenidas</span>
    <br>
    <input type="checkbox" id="weekly_newsletter" name="daily_newsletter" value="1" class="form-checkbox mr-2" checked>
    <span class="text-sm"> Recibir E-mail semanal con el resumen de temas más repetidos</span>

  </div>


  <div id="tab-team" class="tab-content hidden">
    <h2 class="text-xl font-bold mb-3">Acceso y permisos</h2>
    <div class="overflow-x-auto">

      <table class="table-auto w-full">
        <thead class="bg-gray-200">
          <tr>
            <th class="px-4 py-2 text-left">Cuenta</th>
            <th class="px-4 py-2 text-left">Acceso</th>
            <!-- <th class="px-4 py-2 text-left">Status</th>
            <th class="px-4 py-2 text-left">Action</th> -->
          </tr>
        </thead>
        <tbody>
          <? foreach ($_SESSION['user']['accounts'] as $account): ?>
            <tr>
              <td> <?= $account['account_name'] ?></td>
              <td><? if ($_SESSION['user']['usersId'] == $account['usersId']) echo 'Admin';
                  else echo 'Regular Access'; ?></td>
            </tr>
          <? endforeach; ?>

        </tbody>
      </table>
    </div>
  </div>


</div>
</div>

<script>
  $(document).ready(function() {
    function activarTab(tabId) {
      $('.tab-content').addClass('hidden');
      $('#' + tabId).removeClass('hidden');
      $('.tab-btn').removeClass('border-indigo-500 text-indigo-600').addClass('border-transparent text-gray-500');
      $('.tab-btn[data-tab="' + tabId + '"]').addClass('border-indigo-500 text-indigo-600').removeClass('text-gray-500');
    }

    $('.tab-btn').click(function() {
      const tab = $(this).data('tab');
      activarTab(tab);
    });

    // Activar primer tab inicialment
    activarTab('tab-account');
  });
</script>
