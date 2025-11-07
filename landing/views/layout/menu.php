<!-- Uncomment for super top header banner -->



<div class="sticky w-full  z-50 bg-white items-center  shadow-xl  ">
  <div class="text-gray-100 flex gap-x-2 bg-blue-900 px-6 py-0.5 sm:px-3.5 text-center items-center ">
    <a class="text-sm z-50 hover:underline mx-auto hover:font-semibold" href="<?= LANDING_URL ?>demo"> <strong class="text-sm leading-6 text-gray-100 font-semibold inline"><?= _('Build your SaaS today - modify landing/views/layout/menu.php to change this message') ?></strong>

    </a>
    <div class="flex items-center justify-end">
      <!-- <a href="<?= LANDING_URL ?>?lang=es" class="size-5 inline-block mr-2"><img src="<?= APP_CDN ?>flags/es.png"></a>
      <a href="<?= LANDING_URL ?>?lang=en" class="size-5 inline-block mr-2"><img src="<?= APP_CDN ?>flags/us.png"></a> -->
      <!-- <a href=" <?= LANDING_URL ?>signup"">
        <button class=" hidden rounded-full bg-blue-900 px-4 py-1 text-xs text-black font-semibold transition duration-200 ease-out hover:bg-blue-400 lg:block">
          <?= _('Login') ?>

        </button>
      </a> -->
    </div>
  </div>

  <header class="mx-auto w-full z-40  bg-gray-900  ">
    <nav class="flex items-center md:justify-between w-full d:justify-start p-6 lg:px-8 " aria-label="Global">
      <div class="flex lg:flex-1">
        <!-- onclick="document.getElementById('emilio-modal').classList.remove('hidden')"  -->
        <a href="<?= LANDING_URL ?>" class=" -m-1.5 p-1.5 text-gray-100 hover:text-blue-400 font-bold">
          <span class="sr-only"><?= APP_NAME ?></span>
          <img src="<?= APP_LOGO ?>" width="40" class="inline">
          <span class=""><?= APP_NAME ?></span>
        </a>
      </div>
      <div class="flex ml-auto  lg:hidden">
        <button id="button_open_mobile_menu" type="button" class="-m-2.5 inline-flex items-center rounded-md p-2.5 text-gray-400  justify-end">
          <span class="sr-only">Open main menu</span>
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </button>
      </div>
      <div class="hidden lg:flex sm:gap-x-1 lg:gap-x-3 items-center">



        <a href="<?= LANDING_URL ?>" class="text-md font-semibold leading-6 text-gray-600 px-3 py-1 hover:bg-gray-50 hover:text-blue-400 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
          </svg>

          <?= _('Home') ?></a>


        <!-- <a href="<?= LANDING_URL ?>screencasts" class="text-base font-semibold leading-6 text-gray-400 px-3 py-1 hover:bg-gray-900 hover:text-blue-400 rounded-full">Screencasts</a> -->

        <!-- <div class="relative">
          <button type="button" onclick="$('#flyout_menu').toggleClass('hidden');" class="inline-flex items-center gap-x-1 font-semibold text-gray-900" aria-expanded="false">
            <span class="text-md font-semibold leading-6 text-gray-600 px-3 py-1 hover:bg-gray-50 hover:text-blue-400 rounded-full">Casos de uso</span>
            <svg class="size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
              <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
            </svg>
          </button>

  
          <div id="flyout_menu" class="hidden absolute left-1/2 z-10 mt-5 flex w-screen max-w-max -translate-x-1/2 px-4">
            <div class="w-screen max-w-md flex-auto overflow-hidden rounded-3xl bg-white text-sm/6 shadow-lg ring-1 ring-gray-900/5 lg:max-w-3xl">
              <div class="grid grid-cols-1 gap-x-6 gap-y-1 p-4 lg:grid-cols-2">
                <div class="group relative flex gap-x-6 rounded-lg p-4 hover:bg-gray-50">
                  <div class="mt-1 flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                    <svg class="size-6 text-gray-600 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                    </svg>
                  </div>
                  <div>
                    <a href="#" class="font-semibold text-gray-900">
                      Turismo
                      <span class="absolute inset-0"></span>
                    </a>
                    <p class="mt-1 text-gray-600">Gestión automática de Disponibilidad, Calendarios, </p>
                  </div>
                </div>
                <div class="group relative flex gap-x-6 rounded-lg p-4 hover:bg-gray-50">
                  <div class="mt-1 flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                    <svg class="size-6 text-gray-600 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 0 0 2.25-2.25V6a2.25 2.25 0 0 0-2.25-2.25H6A2.25 2.25 0 0 0 3.75 6v2.25A2.25 2.25 0 0 0 6 10.5Zm0 9.75h2.25A2.25 2.25 0 0 0 10.5 18v-2.25a2.25 2.25 0 0 0-2.25-2.25H6a2.25 2.25 0 0 0-2.25 2.25V18A2.25 2.25 0 0 0 6 20.25Zm9.75-9.75H18a2.25 2.25 0 0 0 2.25-2.25V6A2.25 2.25 0 0 0 18 3.75h-2.25A2.25 2.25 0 0 0 13.5 6v2.25a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                  </div>
                  <div>
                    <a href="#" class="font-semibold text-gray-900">
                      E-commerce
                      <span class="absolute inset-0"></span>
                    </a>
                    <p class="mt-1 text-gray-600">Gestión automática de Pedidos, Cambios, Devoluciones</p>
                  </div>
                </div>


              </div>

            </div>
          </div>
        </div> -->


        <a href="<?= LANDING_URL ?>faq" class="text-md font-semibold leading-6 text-gray-600 px-3 py-1 hover:bg-gray-50 hover:text-blue-400 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
          </svg>

          <?= _('FAQ') ?></a>

        <a href="<?= LANDING_URL ?>pricing" class="text-base font-semibold leading-6 text-gray-600 px-3 py-1 hover:bg-gray-50 hover:text-blue-400 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
          </svg>
          <?= _('Pricing') ?></a>

      </div>
      <div class="hidden lg:flex lg:flex-1 lg:justify-end items-center space-x-2">



        <div class="flex items-center ">


          <!-- space for another button  -->

        </div>
        <a class="bg-blue-900 text-sm font-semibold hover:bg-blue-700 text-white rounded-full py-2 px-4 shadow-sm" href="<?= LANDING_URL ?>signup"><?= _('Signup') ?></a>
        <!-- <a href="<?= LANDING_URL ?>signup" class="text-sm font-semibold leading-6 text-gray-400">Empezar ahora </a> -->

        <a href="<?= LANDING_URL ?>login" class="text-sm font-semibold leading-6 text-gray-600 hover:text-black"><?= _('Login') ?> <span aria-hidden="true">&rarr;</span></a>
      </div>
    </nav>
    <!-- Mobile menu, show/hide based on menu open state. -->
    <div class="lg:hidden hidden" role="dialog" aria-modal="true" id="mobile_menu">
      <!-- Background backdrop, show/hide based on slide-over state. -->
      <div class="fixed inset-0 z-50"></div>
      <div class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-gray-900 px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-white/10">
        <div class="flex items-center justify-between">
          <a href="#" class="-m-1.5 p-1.5">
            <span class="sr-only"><?= APP_NAME ?></span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fff" class="w-8 h-8 inline items-center">
              <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
            </svg>
          </a>
          <button type="button" id="button_close_mobile_menu" class="-m-2.5 rounded-md p-2.5 text-gray-400">
            <span class="sr-only">Close menu</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="mt-6 flow-root">
          <div class="-my-6 divide-y divide-gray-500/25">
            <div class="space-y-2 py-6">



              <a href="<?= LANDING_URL ?>" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-400 hover:bg-gray-800"><?= _('Home') ?></a>
              <a href="<?= LANDING_URL ?>faq" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-400 hover:bg-gray-800"><?= _('FAQ') ?></a>
              <a href="<?= LANDING_URL ?>pricing" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-400 hover:bg-gray-800"><?= _('Pricing') ?></a>





            </div>
            <div class="py-6">




              <a href="<?= LANDING_URL ?>login" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-400 hover:bg-gray-800"><?= _('Login') ?></a>
              <a href="<?= LANDING_URL ?>signup" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-400 hover:bg-gray-800"><?= _('Signup') ?></a>


            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

</div>

<?php if (!empty($_SESSION['errors']) and count($_SESSION['errors']) > 0): ?>

  <div id="modal-alert" class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
      <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
          <div class="sm:flex sm:items-start">
            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-sky-100 sm:mx-0 sm:h-10 sm:w-10">
              <svg class="h-6 w-6 text-sky-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
              </svg>
            </div>
            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
              <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title"><?= APP_NAME ?> </h3>
              <div class="mt-2">
                <?php foreach ($_SESSION['errors'] as  $v): ?>
                  <p class="text-sm text-gray-500"><?= $v ?></p>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
          <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
            <button type="button" onclick="$('#modal-alert').addClass('hidden');" class="inline-flex w-full justify-center rounded-md bg-sky-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-sky-500 sm:ml-3 sm:w-auto">Cerrar</button>
          </div>
        </div>

      </div>
    </div>
  </div>

<?php endif; ?>

<?php if (!empty($_SESSION['alerts']) and count($_SESSION['alerts']) > 0): ?>
  <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
    <?php foreach ($_SESSION['alerts'] as $v): ?>
      <span class="block sm:inline"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 inline">
          <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
        </svg>

        <?= $v ?></span><br>
    <?php endforeach; ?>
  </div>
<?php endif; ?>