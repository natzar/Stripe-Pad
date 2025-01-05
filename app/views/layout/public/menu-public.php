<!-- Uncomment for super top header banner -->
<div class="flex items-center gap-x-6 bg-sky-800 px-6 py-2.5 sm:px-3.5 hidden  sm:flex sm:before:flex-1">
  <p class="text-sm leading-6 text-white">
    <a href="#">
      <strong class="font-semibold">Welcome!</strong><svg viewBox="0 0 2 2" class="mx-2 inline h-0.5 w-0.5 fill-current" aria-hidden="true">
        <circle cx="1" cy="1" r="1" />
      </svg>This is <strong>Stripe Pad</strong> demo v.<?= STRIPE_PAD_VERSION ?>
    </a>
  </p>
  <div class="flex flex-1 justify-end">

  </div>
</div>



<div class=" bg-gray-900  shadow-lg ">
  <header class="mx-auto w-full z-50   relative   ">
    <nav class="flex items-center justify-between p-6 lg:px-8 " aria-label="Global">
      <div class="flex lg:flex-1">
        <a href="<?= HOMEPAGE_URL ?>" class="-m-1.5 p-1.5 text-gray-100 hover:text-sky-500 font-bold">
          <span class="sr-only"><?= APP_NAME ?></span>
          <img src="<?= APP_LOGO ?>" width="40" class="inline">
          <span class=""><?= APP_NAME ?></span>
        </a>
      </div>
      <div class="flex lg:hidden">
        <button id="button_open_mobile_menu" type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-400">
          <span class="sr-only">Open main menu</span>
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </button>
      </div>
      <div class="hidden lg:flex lg:gap-x-12 items-center">



        <a href="<?= APP_BASE_URL ?>" class="text-md font-semibold leading-6 text-gray-400 px-3 py-1 hover:bg-gray-900 hover:text-sky-500 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
          </svg>
          Home</a>
        <!-- <a href="<?= APP_BASE_URL ?>screencasts" class="text-base font-semibold leading-6 text-gray-400 px-3 py-1 hover:bg-gray-900 hover:text-sky-500 rounded-full">Screencasts</a> -->
        <a href="<?= APP_BASE_URL ?>#pricing" class="text-base font-semibold leading-6 text-gray-400 px-3 py-1 hover:bg-gray-900 hover:text-sky-500 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
          </svg>
          Pricing</a>
        <a href="<?= APP_DOMAIN ?>blog" class="text-md font-semibold leading-6 text-gray-400 px-3 py-1 hover:bg-gray-900 hover:text-sky-500 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
          </svg>

          Blog</a>





        <div class="flex items-center gap-2 space-x-2">
          <a href="https://github.com/natzar/stripe-pad" target="_blank" rel="noreferrer" class="group hidden items-center space-x-2 rounded px-2.5 py-1 text-xs text-gray-300 transition duration-200 ease-out hover:bg-neutral-200 lg:flex">
            <div class="flex h-3 w-3 items-center justify-center text-neutral-700 group-hover:h-4 group-hover:w-4 group-hover:text-sky-500"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
              </svg></div><span class="truncate text-gray-300">Star us on GitHub</span>
          </a>
          <a href="https://stripepad.com/#download">
            <button class="hidden rounded bg-sky-500 px-2.5 py-1 text-xs text-white transition duration-200 ease-out hover:bg-sky-400 lg:block">
              Download Stripe Pad

            </button>
          </a>
          <a href="https://github.com/natzar/Stripe-Pad" target="_blank" rel="noreferrer" class="hidden border-b-2 border-transparent py-5 text-neutral-700 hover:border-sky-500 hover:text-sky-500 hover:opacity-75 lg:flex"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
              <title>GitHub</title>
              <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"></path>
            </svg></a><a href="https://discord.com/channels/1321059009012432980/1321059060576944130" target="_blank" rel="noreferrer" class="hidden border-b-2 border-transparent py-5 text-neutral-700 hover:border-sky-500 hover:text-sky-500 hover:opacity-75 lg:flex"><svg width="24" height="24" fill="currentColor" viewBox="0 5 30.67 23.25">
              <title>Discord</title>
              <path d="M26.0015 6.9529C24.0021 6.03845 21.8787 5.37198 19.6623 5C19.3833 5.48048 19.0733 6.13144 18.8563 6.64292C16.4989 6.30193 14.1585 6.30193 11.8336 6.64292C11.6166 6.13144 11.2911 5.48048 11.0276 5C8.79575 5.37198 6.67235 6.03845 4.6869 6.9529C0.672601 12.8736 -0.41235 18.6548 0.130124 24.3585C2.79599 26.2959 5.36889 27.4739 7.89682 28.2489C8.51679 27.4119 9.07477 26.5129 9.55525 25.5675C8.64079 25.2265 7.77283 24.808 6.93587 24.312C7.15286 24.1571 7.36986 23.9866 7.57135 23.8161C12.6241 26.1255 18.0969 26.1255 23.0876 23.8161C23.3046 23.9866 23.5061 24.1571 23.7231 24.312C22.8861 24.808 22.0182 25.2265 21.1037 25.5675C21.5842 26.5129 22.1422 27.4119 22.7621 28.2489C25.2885 27.4739 27.8769 26.2959 30.5288 24.3585C31.1952 17.7559 29.4733 12.0212 26.0015 6.9529ZM10.2527 20.8402C8.73376 20.8402 7.49382 19.4608 7.49382 17.7714C7.49382 16.082 8.70276 14.7025 10.2527 14.7025C11.7871 14.7025 13.0425 16.082 13.0115 17.7714C13.0115 19.4608 11.7871 20.8402 10.2527 20.8402ZM20.4373 20.8402C18.9183 20.8402 17.6768 19.4608 17.6768 17.7714C17.6768 16.082 18.8873 14.7025 20.4373 14.7025C21.9717 14.7025 23.2271 16.082 23.1961 17.7714C23.1961 19.4608 21.9872 20.8402 20.4373 20.8402Z"></path>
            </svg></a><a href="https://twitter.com/betoayesa" target="_blank" rel="noreferrer" class="hidden border-b-2 border-transparent py-5 text-neutral-700 hover:border-sky-500 hover:text-sky-500 hover:opacity-75 lg:flex"><svg width="24" height="24" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
              <title>X</title>
              <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865l8.875 11.633Z"></path>
            </svg></a>
        </div>



      </div>
      <div class="hidden lg:flex lg:flex-1 lg:justify-end">
        <a href="<?= APP_DOMAIN ?>login" class="text-sm font-semibold leading-6 text-gray-400">Log in <span aria-hidden="true">&rarr;</span></a>
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



              <a href="<?= APP_BASE_URL ?>" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-400 hover:bg-gray-800">Home</a>

              <a href="https://github.com/natzar/Stripe-Pad/wiki" target="_blank" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-400 hover:bg-gray-800">Documentation</a>

              <a href="https://www.github.com/natzar/Stripe-Pad" target="_blank" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-400 hover:bg-gray-800">Github</a>
              <!-- 


                <a href="<?= APP_BASE_URL ?>examples" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-400 hover:bg-gray-800">Examples</a>

                <a href="https://github.com/natzar/Stripe-Pad/wiki" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-400 hover:bg-gray-800">Documentation</a> -->




            </div>
            <div class="py-6">




              <a href="<?= APP_DOMAIN ?>login" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-400 hover:bg-gray-800">Login</a>
              <a href="<?= APP_DOMAIN ?>signup" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-400 hover:bg-gray-800">Sign Up</a>


            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

</div>