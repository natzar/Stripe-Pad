<? include "app/views/layout/page_header.php"; ?>



<div class=" mx-auto ">
  <div class="border-b border-gray-200 mb-6">
    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
      <button data-tab="tab-account" class="tab-btn group inline-flex items-center border-b-2 px-1 py-4 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
        <svg class="-ml-0.5 mr-2 size-5 text-gray-400 group-hover:text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
          <path d="M10 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM3.465 14.493a1.23 1.23 0 0 0 .41 1.412A9.957 9.957 0 0 0 10 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 0 0-13.074.003Z" />
        </svg> Datos
      </button>
      <button data-tab="tab-notifications" class="tab-btn group inline-flex items-center border-b-2 px-1 py-4 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
        Notificaciones
      </button>
      <button data-tab="tab-team" class="tab-btn group inline-flex items-center border-b-2 px-1 py-4 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
        Acceso y Permisos
      </button>
      <button data-tab="tab-billing" class="tab-btn group inline-flex items-center border-b-2 px-1 py-4 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
        Facturas y Membresías
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
            <div class="w-1/2  ">
              <div class="col-span-1">

                <div class="">
                  <form action="<?= APP_DOMAIN ?>actionUpdateUser" method="POST">
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
                      <p class="text-sm">Importante para todas las notificaciones y alertas. Este email no se puede modificar, contacta con ventas si necesitas recibir las notificaciones en otras cuentas de email</p>
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
                      <label for="language" class="block text-sm font-medium text-gray-700">Idioma</label>
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
                      <label for="vat" class="block text-sm font-medium text-gray-700"><?= _('Bussiness Id / VAT / CIF / NIF (Taxes)') ?></label>
                      <input required="required" type="text" name="nif" value="<?= $user['tax_id'] ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>




                    <input type="submit" class="cursor-pointer rounded-full  bg-gray-100 text-gray-400 hover:bg-sky-800 hover:text-white px-5 py-3 rounded text-sm font-bold" value="<?= _('Update Profile') ?>">

                </div>


                </form>
              </div>



            </div>
            <!-- Sidebar Column -->
            <div class="w-1/2   ml-4">
              <!-- Documentos -->


              <div class="bg-white p-6 rounded-lg shadow-md mb-5">
                <form action="<?= APP_DOMAIN ?>actionUpdateuser" method="POST">

                  <div class="relative">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                      <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-start">
                      <span class="bg-white  text-base font-semibold leading-6 text-gray-900"><?= _('Change your password') ?></span>
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
          <? foreach ($_SESSION['user']['agents'] as $agent): ?>
            <tr>
              <td> <?= $agent['agent_organization'] ?></td>
              <td><? if ($_SESSION['user']['usersId'] == $agent['usersId']) echo 'Admin';
                  else echo 'Regular Access'; ?></td>
            </tr>
          <? endforeach; ?>

        </tbody>
      </table>
    </div>
  </div>

  <div id="tab-billing" class="tab-content hidden">
    <h2 class="text-xl font-semibold mb-4">Facturas y Membresías</h2>
    <p>Gestionas Membresías, consulta y descarga facturas.</p>

    <section aria-labelledby="recent-hires-title" class="mb-10">



      <div class="rounded-lg bg-white overflow-hidden shadow mb-5">
        <div class="p-6">
          <h2 class="text-base font-medium text-gray-900"><?= _('Invoices') ?></h2>
          <a href="/account" target="_blank" class="border-transparent rounded-md bg-sky-600 text-gray-100 hover:bg-sky-800 inline-flex items-center px-3 py-2 text-sm font-bold">
            Ver todas las Facturas
          </a>
          <p class="text-xs text-gray-500">Se abrirá Stripe en una nueva ventana</p>


          <ul role="list" class="hidden divide-y divide-gray-100 overflow-hidden bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">

            <? foreach ($invoices as $invoice): ?>



              <li class="relative flex justify-between gap-x-6 px-4 py-5 hover:bg-gray-50 sm:px-6">
                <div class="flex min-w-0 gap-x-4">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                  </svg>

                  <div class="min-w-0 flex-auto">
                    <p class="text-sm font-semibold leading-6 text-gray-900">
                      <a href="#">
                        <span class="absolute inset-x-0 -top-px bottom-0"></span>
                        #<?= $invoice['invoicesId'] ?>
                      </a>
                    </p>
                    <p class="mt-1 flex text-xs leading-5 text-gray-500">
                      <?= $invoice['cart'] ?>

                    </p>
                  </div>
                </div>
                <div class="flex shrink-0 items-center gap-x-4">
                  <div class="hidden sm:flex sm:flex-col sm:items-end">
                    <p class="text-sm leading-6 text-gray-900"><?= $invoice['total']; ?>&euro;</p>
                    <p class="mt-1 text-xs leading-5 text-gray-500">Fecha Factura <time datetime="2023-01-23T13:23Z"><?= $invoice['created'] ?> </time></p>
                  </div>
                  <a target="_blank" alt="download" href="https://app.phpninja.net/uploads/users/<?= $invoice['pdf_path'] ?>" class="cursor-pointer">
                    <svg class="h-8 w-8 cursor-pointer flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                      <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                    </svg>
                  </a>
                </div>
              </li>



            <? endforeach; ?>

          </ul>

        </div>
      </div>


    </section>

    <div class="mt-5">
      <h2 class="text-xl font-bold mb-3">Subscriptions</h2>
      <div class="overflow-x-auto">
        <table class="table-auto w-full">
          <thead class="bg-gray-200">
            <tr>
              <th class="px-4 py-2 text-left">Date</th>
              <th class="px-4 py-2 text-left">Membership</th>
              <th class="px-4 py-2 text-left">Status</th>
              <th class="px-4 py-2 text-left">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="4"><?= _('No subscriptions found') ?></td>
            </tr>
            <!-- <tr class="border-b">
                        <td class="px-4 py-2">0001</td>
                        <td class="px-4 py-2">2024-03-31</td>
                        <td class="px-4 py-2">$100.00</td>
                        <td class="px-4 py-2 text-green-500">Paid</td>
                        <td class="px-4 py-2">
                            <a href="#" class="text-blue-500 hover:text-blue-800">View</a>
                        </td>
                    </tr> -->
            <!-- Repeat for other invoices -->
          </tbody>
        </table>
      </div>
    </div>
    <div class="mt-5">
      <h2 class="text-xl font-bold mb-3">Invoices</h2>
      <div class="overflow-x-auto">
        <table class="table-auto w-full">
          <thead class="bg-gray-200">
            <tr>
              <th class="px-4 py-2 text-left">Invoice ID</th>
              <th class="px-4 py-2 text-left">Date</th>
              <th class="px-4 py-2 text-left">Amount</th>
              <th class="px-4 py-2 text-left">Status</th>
              <th class="px-4 py-2 text-left">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="4"><?= _('No invoices found') ?></td>
            </tr>
            <!-- <tr class="border-b">
                        <td class="px-4 py-2">0001</td>
                        <td class="px-4 py-2">2024-03-31</td>
                        <td class="px-4 py-2">$100.00</td>
                        <td class="px-4 py-2 text-green-500">Paid</td>
                        <td class="px-4 py-2">
                            <a href="#" class="text-blue-500 hover:text-blue-800">View</a>
                        </td>
                    </tr> -->
            <!-- Repeat for other invoices -->
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




</form>