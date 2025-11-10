<meta name="robots" content="noindex">

<div class=" mt-1 sm:mt-5 mb-4 sm:px-6 w-full prose max-w-8xl prose-violet text-gray-600 mx-auto   ">

    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">

            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Create new account</h2>



        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="<?= LANDING_URL ?>actionSignup" method="POST">
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-700">Email address</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" placeholder="email@mail.com" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-violet-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <input type="text" autocomplete="no" name="hney" value="" style="height:0px;width:0px;overflow:hidden;border:none;padding:0px">

                <input type="text" autocomplete="no" name="name" value="" style="height:0px;width:0px;overflow:hidden;border:none;padding:0px">

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-violet-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-violet-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-600">Sign up</button>
                </div>
            </form>
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
                <span class="block  mt-3 text-xs text-gray-400 sm:mt-4"> Explore domains, technologies, plugins, modules, hosting, expiration dates, location and more.
                    <br>Current index total: 110,731,857 domains

                </span>
            </div>

            <p class="mt-10 text-center text-sm text-gray-500">
                Already a member?
                <a href="<?= LANDING_URL ?>login" class="font-semibold leading-6 text-violet-600 hover:text-violet-500">Login here</a>
            </p>
        </div>
    </div>

</div>