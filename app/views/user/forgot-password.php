<meta name="robots" content="noindex">


<div class=" mt-1 sm:mt-5 mb-4 sm:px-6 w-full prose max-w-8xl prose-sky text-gray-600 mx-auto  ">

  <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">

      <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-100">Recover your password</h2>
    </div>

    <? if (isset($_SESSION['errors']) and !empty($_SESSION['errors'])): ?>
      <div class="sm:mx-auto rounded-md mt-5 sm:w-full sm:max-w-sm bg-gray-900 border-sky-600 border-1 border py-4 px-5 font-semibold text-sky-600">
        <?= $_SESSION['errors'] ?>
      </div>
    <? endif; ?>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" action="actionRecoverPassword" autocomplete="no" method="POST">
        <div>
          <label for="email" class="block text-sm font-medium leading-6 text-gray-700">Email address</label>
          <div class="mt-2">
            <input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-600 sm:text-sm sm:leading-6">

            <input type="text" name="name" value="" autocomplete="no" style="height:0px;width:0px;overflow:hidden;border:none;padding:0px">
          </div>
        </div>



        <div>
          <button type="submit" class="flex w-full justify-center rounded-md bg-sky-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600">Reset password</button>
        </div>
      </form>

      <p class="mt-10 text-center text-sm text-gray-500">
        Not a member?
        <a href="<?= APP_DOMAIN ?><?= $_SESSION['user']['lang'] ?>/signup" class="font-semibold leading-6 text-sky-600 hover:text-sky-500">Signup</a>
      </p>
    </div>
  </div>

</div>