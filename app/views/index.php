<header class="py-6 border-gray-600  bg-gray-900">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 ">
        <h1 class="text-3xl font-bold tracking-tight text-gray-100">Dashboard</h1>
        <p class="text-base leading-8 text-gray-300">You are signed up as "<?= $_SESSION['user']['group'] ?>" - Only registered users can see this</p>
    </div>
</header>



<div class="flex min-h-screen flex-col bg-gray-800">


    <div class="mx-auto flex w-full max-w-7xl items-start gap-x-8 px-4 py-10 sm:px-6 lg:px-8">
        <? include_once "layout/sidebar-private.php"; ?>

        <main class="flex-1 text-gray-100">
            <h2 class="font-bold text-2xl text-white">My Awesome Protected Tool</h2>

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