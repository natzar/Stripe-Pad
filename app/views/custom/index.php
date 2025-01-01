<header class="pb-6 ">
    <div class="mx-auto  ">
        <h1 class="text-3xl font-bold tracking-tight text-gray-700">The App</h1>
    </div>
</header>



<div class="flex min-h-screen flex-col">


    <div class="mx-auto flex w-full items-start gap-x-8 ">


        <main class="flex-1 text-gray-600">
            <h2 class="font-bold text-2xl text-white">Your Awesome Protected Tool</h2>
            <p class="text-base leading-8 text-gray-300">This could be a great place to insert your code. You are signed up as "<?= $_SESSION['user']['group'] ?>" - Only registered users can see this</p>

            <p>You are loged in, this is what a user will see after signing up via stripe + webhook + password in an email.<br>
                <br>

                [ INSERT YOUR TOOL OR MAGIC here!]<br>
                or<bR>
                [ SHOW PRODUCTS TO BECOME A CUSTOMER]<br><br>

                /app/views/index.php - Main File and entry point for content reserver for users, customers and superadmin. Not public.
            </p>
        </main>

        <aside class="sticky top-8 hidden w-96 shrink-0 xl:block">
            <!-- Right column area -->R col
        </aside>
    </div>
</div>