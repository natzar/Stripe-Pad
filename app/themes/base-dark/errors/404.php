<div class="bg-green-600 flex min-h-screen flex-col pt-16 pb-12">
  <main class="mx-auto flex w-full max-w-7xl flex-grow flex-col justify-center px-4 sm:px-6 lg:px-8">
    <div class="flex flex-shrink-0 justify-center">
      <a href="/" class="inline-flex">
        <span class="sr-only"><?= APP_NAME ?></span>
        <img class="h-12 w-auto" src="<?= APP_LOGO ?>" alt="">
      </a>
    </div>
    <div class="py-16">
      <div class="text-center">
        <p class="text-7xl font-bold text-white">404</p>
        <h1 class="mt-2 text-4xl font-bold tracking-tight text-gray-100 sm:text-5xl">Page not found.</h1>
        <p class="mt-2 text-base text-gray-100">Sorry, we couldn’t find the page you’re looking for.<br>
        Coordinates: <? print_r($_GET); ?></p>
        
        <div class="mt-6">
          <a href="<?= APP_BASE_URL ?>" class="text-base font-medium text-green-100 hover:text-green-800">
            Go back home
            <span aria-hidden="true"> &rarr;</span>
          </a>
        </div>
      </div>
    </div>
  </main>
  <footer class="mx-auto w-full max-w-7xl flex-shrink-0 px-4 sm:px-6 lg:px-8">
    <nav class="flex justify-center space-x-4">
      <a href="mailto:<?= ADMIN_EMAIL ?>" class="text-sm font-medium text-green-200 hover:text-green-800">Contact Support</a>
      <!-- <span class="inline-block border-l border-gray-300" aria-hidden="true"></span>
      <a href="#" class="text-sm font-medium text-gray-500 hover:text-gray-600">Status</a>
      <span class="inline-block border-l border-gray-300" aria-hidden="true"></span>
      <a href="#" class="text-sm font-medium text-gray-500 hover:text-gray-600">Twitter</a> -->
    </nav>
  </footer>
</div>

