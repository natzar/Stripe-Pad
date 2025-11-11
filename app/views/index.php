<div class="">
  <div class="mx-auto ">
    <h2 class="text-base/7 font-semibold text-indigo-600">Welcome to <?= APP_NAME ?></h2>
    <p class="mt-2 max-w-lg text-pretty text-4xl font-semibold tracking-tight text-gray-950 sm:text-5xl">This could be the dashboard screen for your saas</p>

  </div>
</div>


<div class="flex min-h-screen flex-col">


  <div class="mx-auto flex w-full items-start gap-x-8 ">


    <main class="flex-1 text-gray-600">

      <p class="text-base ">This could be a great place to insert your code. You are signed up as "<?= $_SESSION['user']['group'] ?>" - Only registered users can see this. You are loged in, this is what a user will see after signing up via stripe + webhook + password in an email.<br>
        <br>
        This is a demo, a Bitcoin price tracker that only registered users can access. You can replace this with your own SaaS or Tool, just code it here or include your favorite JS framework. <br>
      </p>
    </main>

    <aside class="sticky text-gray-600 top-8 hidden w-96 shrink-0 xl:block">
      This is /app/views/index.php - Main File and entry point for content reserver for users, customers and superadmin. Not public, only for registered users.

      <br><br>
      You can use this file to create your SaaS or Tool that only registered users can access
      <br><br>
      You can expand /app/App.php class, or just include a js and work with your favorite JS framework, it will protected against non paying users.
    </aside>
  </div>
</div>