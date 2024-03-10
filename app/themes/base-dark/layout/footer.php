

<div id="alert" class="hidden">
	<!-- This example requires Tailwind CSS v2.0+ -->
<!-- Global notification live region, render this permanently at the end of the document -->
<div aria-live="assertive" class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6">
  <div class="flex w-full flex-col items-center space-y-4 sm:items-end">
    <!--
      Notification panel, dynamically insert this into the live region when it needs to be displayed

      Entering: "transform ease-out duration-300 transition"
        From: "translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
        To: "translate-y-0 opacity-100 sm:translate-x-0"
      Leaving: "transition ease-in duration-100"
        From: "opacity-100"
        To: "opacity-0"
    -->
    <div class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5">
      <div class="p-4">
        <div class="flex items-start">
          <div class="flex-shrink-0">
            <!-- Heroicon name: outline/check-circle -->
            <svg class="h-6 w-6 text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
          <div class="ml-3 w-0 flex-1 pt-0.5">
            <p class="text-sm font-medium text-gray-900">Successfully saved!</p>
            <p class="mt-1 text-sm text-gray-500">Anyone with a link can now view this file.</p>
          </div>
          <div class="ml-4 flex flex-shrink-0">
            <button type="button" class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
              <span class="sr-only">Close</span>
              <!-- Heroicon name: mini/x-mark -->
              <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</div>

<div class="relative isolate overflow-hidden bg-gray-900 px-6 py-24 text-center shadow-2xl border-b border-gray-800  sm:px-16 ">
      <h2 class="mx-auto max-w-2xl text-3xl font-bold tracking-tight text-white sm:text-4xl">Start your SaaS Today!</h2>
      <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-gray-300">Everything you need to focus only in your original idea</p>
      <div class="mt-10 flex items-center justify-center gap-x-6">
        <a href="/signup" class="rounded-md bg-red-600 px-3.5 py-2.5 text-sm font-semibold text-gray-100 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">Sign up</a>
        <!-- <a href="https://www.domstry.com/resources/domstry-mautic-leads" class="text-sm font-semibold leading-6 text-white">Learn more <span aria-hidden="true">→</span></a> -->
      </div>
     <svg viewBox="0 0 1024 1024" class="absolute left-1/2 top-1/2 -z-10 h-[64rem] w-[64rem] -translate-x-1/2 [mask-image:radial-gradient(closest-side,white,transparent)]" aria-hidden="true">
    <circle cx="512" cy="512" r="512" fill="url(#827591b1-ce8c-4110-b064-7cb85a0b1217)" fill-opacity="0.7"></circle>
    <defs>
        <radialGradient id="827591b1-ce8c-4110-b064-7cb85a0b1217">
            <stop stop-color="#6AC47E"></stop> <!-- Light Red -->
            <stop offset="1" stop-color="#008037"></stop> <!-- Dark Red -->
        </radialGradient>
    </defs>
</svg>

    </div>
<!-- FOOTer -->
<footer class="bg-gray-900 " aria-labelledby="footer-heading">
  <h2 id="footer-heading" class="sr-only">Footer</h2>
  <div class="mx-auto max-w-7xl px-6 pb-8 pt-16 sm:pt-24 lg:px-8 lg:pt-32">
    <div class="xl:grid xl:grid-cols-3 xl:gap-8">
      <div class="space-y-8">
       <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fff" class="w-7 h-7 inline items-center">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0 1 12 15a9.065 9.065 0 0 0-6.23-.693L5 14.5m14.8.8 1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0 1 12 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" />
</svg>

        <p class="text-sm leading-6 text-gray-500">



PHP Micro SaaS Boilerplate already wired to Stripe 

        </p>
        <div class="flex space-x-6">
         <!--  <a href="#" class="text-gray-500 hover:text-gray-400">
            <span class="sr-only">Facebook</span>
            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
            </svg>
          </a>
          <a href="#" class="text-gray-500 hover:text-gray-400">
            <span class="sr-only">Instagram</span>
            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
            </svg>
          </a>
          <a href="#" class="text-gray-500 hover:text-gray-400">
            <span class="sr-only">X</span>
            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path d="M13.6823 10.6218L20.2391 3H18.6854L12.9921 9.61788L8.44486 3H3.2002L10.0765 13.0074L3.2002 21H4.75404L10.7663 14.0113L15.5685 21H20.8131L13.6819 10.6218H13.6823ZM11.5541 13.0956L10.8574 12.0991L5.31391 4.16971H7.70053L12.1742 10.5689L12.8709 11.5655L18.6861 19.8835H16.2995L11.5541 13.096V13.0956Z" />
            </svg>
          </a>
          <a href="#" class="text-gray-500 hover:text-gray-400">
            <span class="sr-only">GitHub</span>
            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
            </svg>
          </a>
          <a href="#" class="text-gray-500 hover:text-gray-400">
            <span class="sr-only">YouTube</span>
            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path fill-rule="evenodd" d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z" clip-rule="evenodd" />
            </svg>
          </a> -->
        </div>
      </div>
      <div class="mt-16 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
        <div class="md:grid md:grid-cols-2 md:gap-8">
          <div>
            <h3 class="text-sm font-semibold leading-6 text-white">Stripe Pad</h3>
            <ul role="list" class="mt-6 space-y-4">
              <li>
                <a href="<?= APP_DOMAIN ?>" class="text-sm leading-6 text-gray-300 hover:text-white">Home</a>
              </li>

              <li>
                <a href="<?= APP_DOMAIN ?>installation" class="text-sm leading-6 text-gray-300 hover:text-white">Installation</a>
              </li>
              <li>
                <a href="https://github.com/natzar/Stripe-Pad/wiki" class="text-sm leading-6 text-gray-300 hover:text-white">Documentation</a>
              </li>
              <li>
                <a href="<?= APP_DOMAIN ?>examples" class="text-sm leading-6 text-gray-300 hover:text-white">Examples</a>
              </li>
              <li><a href="https://github.com/natzar/Stripe-Pad" class="text-sm leading-6 text-gray-300 hover:text-white">Download</a></li>
             
              
            </ul>
          </div>
          <div class="mt-10 md:mt-0">
            <h3 class="text-sm font-semibold leading-6 text-white">Components</h3>
            <ul role="list" class="mt-6 space-y-4">
              

            <li><a href="login" class="text-sm leading-6 text-gray-300 hover:text-white">Login</a></li>

<li><a href="signup" class="text-sm leading-6 text-gray-300 hover:text-white">Signup</a></li>
<li><a href="sample" class="text-sm leading-6 text-gray-300 hover:text-white">Sample page</a></li>
<li><a href="throw-an-error" class="text-sm leading-6 text-gray-300 hover:text-white">Errors</a></li>
                
            <li>
                <a href="<?= APP_DOMAIN ?>blog" class="text-sm leading-6 text-gray-300 hover:text-white">Blog</a>
              </li>


            </ul>
          </div>
        </div>
        <div class="md:grid md:grid-cols-2 md:gap-8">
          
          <div class="mt-10 md:mt-0">
            <h3 class="text-sm font-semibold leading-6 text-white">Company</h3>
            <ul role="list" class="mt-6 space-y-4">
  
  
     
              <li>
                <a href="privacy" class="text-sm leading-6 text-gray-300 hover:text-white">Privacy</a>
              </li>
              <li>
                <a href="tos" class="text-sm leading-6 text-gray-300 hover:text-white">Terms of service</a>
              </li>

  
         <li>
          <a href="mailto:<?= ADMIN_EMAIL ?>" class="text-sm leading-6 text-gray-300 hover:text-white"><?= ADMIN_EMAIL ?></a>
</li>



            </ul>
          </div>
          <div>
            
          </div>

        </div>
      </div>
    </div>
     <div class="mt-16 border-t border-white/10 pt-8 sm:mt-20 lg:mt-24 lg:flex lg:items-center lg:justify-between">
      <div>
        <h3 class="text-sm font-semibold leading-6 text-white">Subscribe to our newsletter</h3>
        <p class="mt-2 text-sm leading-6 text-gray-400">The latest domain news, sent to your inbox weekly.</p>
      </div>
      <form class="mt-6 sm:flex sm:max-w-md lg:mt-0" action="actionSignup" method="POST">
        <label for="email-address" class="sr-only">Email address</label>
        <input type="email" name="email" id="email" autocomplete="email" required class="w-full min-w-0 appearance-none rounded-md border-0 bg-white/5 px-3 py-1.5 text-base text-white shadow-sm ring-1 ring-inset ring-white/10 placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:w-56 sm:text-sm sm:leading-6" placeholder="Enter your email">
        <div class="mt-4 sm:ml-4 sm:mt-0 sm:flex-shrink-0">
          <button type="button" onclick="alert('Not collecting emails but you can do it easily');" class="flex w-full items-center justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-500">Subscribe</button>
        </div>
      </form>
    </div>
    <div class="mt-10 border-t border-white/10 pt-8 ">
      <p class="text-xs leading-5 text-gray-400"><a href="<?= APP_BASE_URL ?>"><?= APP_DOMAIN ?></a> <?= $SEO_TITLE ?> &copy; <?= Date("Y") ?> Ayesa Digital SLU. All rights reserved</p>
      <p class="text-xs leading-5 text-gray-600">
        Powered by  <a href="//stripepad.com">Stripe Pad v.0.0.1 </a> · Made by <a href="https://www.twitter.com/betoayesa" target="_blank">@betoayesa</a>, maintenance by <a href="https://www.phpninja.es" target="_blank">Php Ninja</a> · Get Support: <a href="mailto:<?= ADMIN_EMAIL ?>"><?= ADMIN_EMAIL ?></a></p>


    </div>
  </div>
</footer>



 <!-- Floating feedback div -->
    <div id="feedbackDiv" style="padding:20px;position: fixed;
    bottom: 10px;
    right: 10px;" class=" bg-indigo-500 text-xs items-center px-4 text-white p-2 rounded cursor-pointer hidden">

    <svg id="welcome_close" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" style="float:right">
  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
</svg>


       <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="block w-20 h-20 mx-auto">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" />
</svg>
<p class="max-w-xs mt-8  text-sm font-semibold block">



🤞 <a class="hover:underline" href="#" id="trigger">Click here to send feedback!</a>
<br><br>
<span class="text-xs font-light ">Powered by  <a href="//stripepad.com">Stripe Pad v.0.0.1 </a> · Made by <a href="https://www.twitter.com/betoayesa" target="_blank">@betoayesa</a></span>
</p>
    </div>

<script src="<?= APP_CDN ?>app/landing.js?v=1"  ></script>
<script><?= $HOOK_JS ?></script>
</body>
</html>


