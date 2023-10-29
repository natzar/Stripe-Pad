
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
      <div
        class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800"
      >
        <div class="flex flex-col overflow-y-auto md:flex-row">
          <div class="h-32 md:h-auto md:w-1/2">
            <img
              aria-hidden="true"
              class="object-cover w-full h-full dark:hidden"
              src="https://cdn.gophpninja.com/img/login-office.jpeg"               alt="Office"
            />
            <img
              aria-hidden="true"
              class="hidden object-cover w-full h-full dark:block"
              src="https://cdn.gophpninja.com/img/forgot-password-office-dark.jpeg"
              alt="Office"
            />
          </div>
          <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
            <div class="w-full">
	          <? if (!empty(APP_LOGO)): ?>
				   <img class=""  src="https://www.phpninja.net/phpninja-logo.png">
				<? else: ?>
				 <h1 class="mb-10 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Recover Password 
              </h1>				
			  <? endif; ?>
              <form action="/actionRecoverPassword" method="POST">
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Your Email</span>              </label>
                <input name="email" type="email"
                  class="block block w-full shadow-sm focus:ring-light-blue-500 focus:border-light-blue-500 sm:text-sm border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="email@gmail.com"
                />


              <!-- You should use a button here, as the anchor is only used for the example  -->
              <input type="submit"      class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" value="Recuperar Password">
              


              </form>
              <? if (isset($_GET['success'])): ?>
<!-- This example requires Tailwind CSS v2.0+ -->
<div class="rounded-md bg-green-50 p-4">
  <div class="flex">
    <div class="flex-shrink-0">
      <!-- Heroicon name: solid/check-circle -->
      <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
      </svg>
    </div>
    <div class="ml-3">
      <h3 class="text-sm font-medium text-green-800">
Email enviado  🚀 
      </h3>
     
<!--
      <div class="mt-4">
        <div class="-mx-2 -my-1.5 flex">
          <button type="button" class="bg-green-50 px-2 py-1.5 rounded-md text-sm font-medium text-green-800 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-50 focus:ring-green-600">
            View status
          </button>
          <button type="button" class="ml-3 bg-green-50 px-2 py-1.5 rounded-md text-sm font-medium text-green-800 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-50 focus:ring-green-600">
            Dismiss
          </button>
        </div>
      </div>
-->
    </div>
  </div>
</div>

<? endif; ?>
 <p class="mt-4">
                <a  class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"   href="<?= APP_BASE_URL ?>login">                
                  Volver a login
                </a>
              </p>


            </div>
          </div>
        </div>
      </div>
    </div>
