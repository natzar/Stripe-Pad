<meta name="robots" content="noindex">

<div class=" mt-1 sm:mt-5 mb-4 sm:px-6 w-full prose max-w-8xl prose-violet text-gray-600 mx-auto   ">

    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">

            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-100">Create new account</h2>



        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="<?= LANDING_URL ?>actionSignup" method="POST">
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-500">Email address</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" placeholder="email@mail.com" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-violet-600 sm:text-sm sm:leading-6">
                        <p class="block mt-2 text-xs font-medium leading-6 text-gray-600">Password will be sent to this email address</p>
                    </div>
                </div>

                <input type="text" autocomplete="no" name="hney" value="" style="height:0px;width:0px;overflow:hidden;border:none;padding:0px">

                <input type="text" autocomplete="no" name="name" value="" style="height:0px;width:0px;overflow:hidden;border:none;padding:0px">

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-violet-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-violet-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-600">Sign up</button>
                </div>
            </form>
            <div>
                <div class="relative mt-10">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm/6 font-medium">
                        <span class="bg-white px-6 text-gray-900">Or continue with</span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-4">
                    <a href="http://localhost/stripe-pad/auth/google" class="flex w-full items-center justify-center gap-3 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:ring-transparent">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12.0003 4.75C13.7703 4.75 15.3553 5.36002 16.6053 6.54998L20.0303 3.125C17.9502 1.19 15.2353 0 12.0003 0C7.31028 0 3.25527 2.69 1.28027 6.60998L5.27028 9.70498C6.21525 6.86002 8.87028 4.75 12.0003 4.75Z" fill="#EA4335"></path>
                            <path d="M23.49 12.275C23.49 11.49 23.415 10.73 23.3 10H12V14.51H18.47C18.18 15.99 17.34 17.25 16.08 18.1L19.945 21.1C22.2 19.01 23.49 15.92 23.49 12.275Z" fill="#4285F4"></path>
                            <path d="M5.26498 14.2949C5.02498 13.5699 4.88501 12.7999 4.88501 11.9999C4.88501 11.1999 5.01998 10.4299 5.26498 9.7049L1.275 6.60986C0.46 8.22986 0 10.0599 0 11.9999C0 13.9399 0.46 15.7699 1.28 17.3899L5.26498 14.2949Z" fill="#FBBC05"></path>
                            <path d="M12.0004 24.0001C15.2404 24.0001 17.9654 22.935 19.9454 21.095L16.0804 18.095C15.0054 18.82 13.6204 19.245 12.0004 19.245C8.8704 19.245 6.21537 17.135 5.2654 14.29L1.27539 17.385C3.25539 21.31 7.3104 24.0001 12.0004 24.0001Z" fill="#34A853"></path>
                        </svg>
                        <span class="text-sm/6 font-semibold">Google</span>
                    </a>

                    <!-- <a href="#" class="flex w-full items-center justify-center gap-3 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:ring-transparent">
            <svg class="size-5 fill-[#24292F]" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
              <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.484 0 10.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10.017C20 4.484 15.522 0 10 0z" clip-rule="evenodd" />
            </svg>
            <span class="text-sm/6 font-semibold">GitHub</span>
          </a> -->
                    <!-- <a href="http://localhost/stripe-pad/auth/google" class="bg-red-500 text-white p-2 inline-block rounded">Login with Google</a> -->
                    <!-- <a href="/redirectToProvider/facebook" class="bg-blue-600 text-white p-2 inline-block rounded">Login with Facebook</a> -->

                </div>
            </div>
            <div class="mx-auto max-w-2xl text-center">


                <div class="flex items-center space-x-2 justify-center mt-5">
                    <div class="flex flex-shrink-0 -space-x-1">
                        <img class="h-6 w-6 max-w-none rounded-full ring-2 ring-gray-100" src="<?= APP_CDN ?>img/Laia.webp" alt="Laia Uriach">
                        <img class="h-6 w-6 max-w-none rounded-full ring-2 ring-gray-100" src="<?= APP_CDN ?>img/Laura.webp" alt="Laura Guasch">
                        <img class="h-6 w-6 max-w-none rounded-full ring-2 ring-gray-100" src="<?= APP_CDN ?>img/Elsa.webp" alt="Zalo Etxebarria">
                        <img class="h-6 w-6 max-w-none rounded-full ring-2 ring-gray-100" src="<?= APP_CDN ?>img/Luisa.webp" alt="Luisa Aparicio">

                    </div>
                    <span class="flex-shrink-0 text-xs font-medium leading-5 text-gray-600">Join +4400 marketers, seo and security experts</span>
                </div>
                <span class="block  mt-3 text-xs text-gray-400 sm:mt-4"><?= SEO_DESCRIPTION ?>

                </span>
            </div>

            <p class="mt-10 text-center text-sm text-gray-500">
                Already a member?
                <a href="<?= LANDING_URL ?>login" class="font-semibold leading-6 text-violet-600 hover:text-violet-500">Login here</a>
            </p>
        </div>
    </div>

</div>