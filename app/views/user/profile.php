<header class="pb-6 ">
  <div class="mx-auto  ">
    <h1 class="text-3xl font-bold tracking-tight text-gray-800">Profile</h1>


  </div>

</header>



<div class="flex min-h-screen flex-col ">


  <div class="mx-auto flex min-h-screen w-full  items-start gap-x-8 ">



    <main class="flex-1 text-gray-700">

      <div class="flex max-w-6xl mx-auto">
        <!-- Main Content Column -->
        <div class="w-1/2  ">
          <div class="col-span-1">

            <div class="bg-white p-6 rounded-lg shadow-md mb-5">

              <div class="relative">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                  <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-start">
                  <span class="bg-white  text-base font-semibold leading-6 text-gray-900"><?= _('User Profile') ?></span>
                </div>
              </div>
              Rol: <span class="inline-flex items-center gap-x-1.5 rounded-full bg-orange-100 px-2 py-1 text-xs font-medium text-orange-700">
                <svg class="h-1.5 w-1.5 fill-orange-500" viewBox="0 0 6 6" aria-hidden="true">
                  <circle cx="3" cy="3" r="3"></circle>
                </svg>
                <?= $user['group'] ?>
              </span>
              <form action="<?= APP_DOMAIN ?>actionUpdateUser" method="POST">
                <div class="mb-4">
                  <label for="name" class="block text-sm font-medium text-gray-700"><?= _('Name') ?></label>
                  <input type="text" name="name" value="<?= $user['name'] ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required="required">
                </div>
                <div class="mb-4">
                  <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                  <input type="email" name="email" value="<?= $user['email'] ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required="required">
                </div>
               

              <div class="mb-4">
                <label for="company" class="block text-sm font-medium text-gray-700"><?= _('Company') ?></label>
                <input required="required" type="text" name="name" value="<?= $user['name'] ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
              </div>
              <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700"><?= _('Address') ?></label>
                <input required="required" type="text" name="address" value="<?= $user['address'] ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
              </div>
              <div class="mb-4">
                <label for="vat" class="block text-sm font-medium text-gray-700"><?= _('Bussiness Id / VAT / CIF / NIF (Taxes)') ?></label>
                <input required="required" type="text" name="nif" value="<?= $user['tax_id'] ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
              </div>

              


                <input type="submit" class="rounded-full  bg-gray-100 text-gray-400 hover:bg-sky-800 hover:text-white px-4 py-2 rounded text-sm font-bold" value="<?= _('Update Profile') ?>">
              </form>
            </div>
          </div>



        </div>
        <!-- Sidebar Column -->
        <div class="w-1/2   ml-4">
          <!-- Documentos -->

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
                <tr><td colspan="4"><?= _('No subscriptions found') ?></td></tr>
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
                <tr><td colspan="4"><?= _('No invoices found') ?></td></tr>  
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
          <div class="bg-white p-6 rounded-lg shadow-md mb-5 text-gray-600">

            
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