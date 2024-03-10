<? if (isset($_GET['success'])): ?>
<!-- This example requires Tailwind CSS v2.0+ -->
<div class="rounded-md bg-red-50 p-4">
  <div class="flex">
    <div class="flex-shrink-0">
      <!-- Heroicon name: solid/check-circle -->
      <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
      </svg>
    </div>
    <div class="ml-3">
      <h3 class="text-sm font-medium text-red-800">
       Pedido completado
      </h3>
      <div class="mt-2 text-sm text-red-700">
        <p>
        👉 Te hemos enviado un email con tus datos de acceso<br>
        ✔  Por favor consulta tu bandeja de entrada de tu correo, o en correo no deseado!<br>
        🚀 Sólo nos faltan los datos de acceso a tu sitio web para empezar a trabajar, podrás enviarlos de forma segura una vez estés dentro.
        </p>
      </div>
<!--
      <div class="mt-4">
        <div class="-mx-2 -my-1.5 flex">
          <button type="button" class="bg-red-50 px-2 py-1.5 rounded-md text-sm font-medium text-red-800 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-red-50 focus:ring-red-600">
            View status
          </button>
          <button type="button" class="ml-3 bg-red-50 px-2 py-1.5 rounded-md text-sm font-medium text-red-800 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-red-50 focus:ring-red-600">
            Dismiss
          </button>
        </div>
      </div>
-->
    </div>
  </div>
</div>

<? endif; ?>
   



    <meta name="robots" content="noindex">


  <div class=" mt-1 sm:mt-5 mb-4 sm:px-6 w-full prose max-w-8xl prose-red text-gray-600 mx-auto  ">
  <!--
  This example requires some changes to your config:
  
  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->
<!--
  This example requires updating your template:

  ```
  <body class="h-full">
  ```
-->
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    
    <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-100">Sign in to your account</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form class="space-y-6" action="actionLogin" method="POST">
      <div>
        <label for="email" class="block text-sm font-medium leading-6 text-gray-100">Email address</label>
        <div class="mt-2">
          <input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm font-medium leading-6 text-gray-100">Password</label>
          <div class="text-sm">
            <a href="forgotPassword" class="font-semibold text-red-600 hover:text-red-500">Forgot password?</a>
          </div>
        </div>
        <div class="mt-2">
          <input id="password" name="password" type="password"  required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <button type="submit" class="flex w-full justify-center rounded-md bg-red-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Sign in</button>
      </div>
    </form>
<?= $_SESSION['errors'] ?>
    <p class="mt-10 text-center text-sm text-gray-500">
      Not a member?
      <a href="signup" class="font-semibold leading-6 text-red-600 hover:text-red-500">Signup</a>
    </p>
  </div>
</div>

  </div>