<div class="bg-gray-100">
    <div class="hidden relative z-50 lg:hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-200/80" aria-hidden="true"></div>
        <div class="fixed inset-0 flex">
            <div class="relative mr-16 flex w-full max-w-xs flex-1">
                <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                    <button type="button" class="-m-2.5 p-2.5">
                        <span class="sr-only">Close sidebar</span>
                        <svg class="size-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Sidebar component, swap this element with another sidebar if you like -->
                <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-gray-100 px-6 pb-4">
                    <div class="flex h-16 shrink-0 items-center">
                        <img class="h-8 w-auto" src="<?= APP_LOGO ?>" alt="<?= APP_NAME ?>">
                    </div>
                    <nav class="flex flex-1 flex-col">
                        <ul class="flex flex-1 flex-col gap-y-7 pt-4">
                            <li>
                                <ul class="-mx-2 space-y-1">
                                    <li>
                                        <!-- Current: "bg-gray-50 text-blue-600", Default: "text-gray-700 hover:text-blue-600 hover:bg-gray-50" -->
                                        <a href="<?= APP_URL ?>" class="group flex gap-x-3 rounded-md bg-gray-50 p-2 text-sm text-blue-600">
                                            <svg class="size-6 shrink-0 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                            </svg>
                                            Inicio
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= APP_URL ?>bitcoin" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-blue-600">
                                            <svg class="size-6 shrink-0 text-gray-400 group-hover:text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3.75-9h7.5a2.25 2.25 0 1 0 0-4.5h-7.5V6Zm0 0V4.5a2.25 2.25 0 0 1 2.25-2.25H12a6.75 6.75 0 0 1 0 13.5h-3.75V15m0 0H6a2.25 2.25 0 1 0 0 4.5h2.25V18m0 0v1.5A2.25 2.25 0 0 0 10.5 21H12a6.75 6.75 0 0 0 0-13.5h-3.75V9" />
                                            </svg>
                                            <?= _('Bitcoin Tracker') ?>
                                        </a>
                                    </li>

                                </ul>
                            </li>



                            <li class="mt-auto">
                                <a href="#" class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-blue-600">
                                    <svg class="size-6 shrink-0 text-gray-400 group-hover:text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                    Settings
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Static sidebar for desktop -->
    <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-64 lg:flex-col">
        <!-- Sidebar component, swap this element with another sidebar if you like -->
        <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-gray-100 px-4 pb-4">



            <div class="flex h-16 shrink-0 items-center">
                <img class="h-8 w-auto" src="<?= APP_LOGO ?>" alt="<?= APP_NAME ?>">
            </div>


            <nav id="sidebar" class="pt-5">
                <ul class="-mx-2 space-y-1">
                    <li>
                        <!-- Current: "bg-gray-50 text-blue-600", Default: "text-gray-700 hover:text-blue-600 hover:bg-gray-50" -->
                        <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                            <svg class="size-6 " fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            Dashboard
                        </a>
                    </li>


                    <li class="mb-5">
                        <a href="<?= APP_URL ?>app_scenarios" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                            </svg>

                            What Ever
                        </a>
                    </li>
                    <li class="mb-5">
                        <a href="<?= APP_URL ?>bitcoin" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3.75-9h7.5a2.25 2.25 0 1 0 0-4.5h-7.5V6Zm0 0V4.5a2.25 2.25 0 0 1 2.25-2.25H12a6.75 6.75 0 0 1 0 13.5h-3.75V15m0 0H6a2.25 2.25 0 1 0 0 4.5h2.25V18m0 0v1.5A2.25 2.25 0 0 0 10.5 21H12a6.75 6.75 0 0 0 0-13.5h-3.75V9" />
                            </svg>
                            <?= _('Bitcoin Tracker') ?>
                        </a>
                    </li>
                    <li>
                        <div class="text-xs/6 font-semibold text-gray-400">Sidebar Subheader</div>
                    </li>
                    <li class="mb-5">
                        <a href="<?= APP_URL ?>app_conversations/unknown" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                            </svg>
                            Subitem
                        </a>
                    </li>




                    <li>
                        <div class="text-xs/6 font-semibold text-gray-400">User</div>
                    </li>


                    <li>
                        <!-- Current: "bg-gray-50 text-blue-600", Default: "text-gray-700 hover:text-blue-600 hover:bg-gray-50" -->
                        <a href="<?= APP_URL ?>profile" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>


                            <?= _('User Profile') ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?= APP_URL ?>account" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5h18M3 12h18M3 16.5h18M6.75 6v12m10.5-12v12" />
                            </svg>
                            <?= _('Account Settings') ?>
                        </a>
                    </li>
                    <li>
                        <!-- Current: "bg-gray-50 text-blue-600", Default: "text-gray-700 hover:text-blue-600 hover:bg-gray-50" -->
                        <a href="<?= APP_URL ?>contact" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
                            </svg>


                            <?= _('Help & Support') ?>
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
    </div>

    <div class="lg:pl-64">
        <div class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4  px-4 z-50 bg-gray-100 sm:gap-x-6 sm:px-6 lg:px-8">
            <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden">
                <span class="sr-only">Open sidebar</span>
                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>



            <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
                <form class="grid flex-1 grid-cols-1" action="#" method="GET">
                    <input type="search" name="search" aria-label="Search" class="hidden col-start-1 row-start-1 block size-full bg-gray-200 pl-8 text-base text-gray-900 outline-none placeholder:text-gray-400 sm:text-sm border-0" placeholder="Search">
                    <svg class="hidden pointer-events-none col-start-1 row-start-1 size-5 self-center text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" />
                    </svg>
                </form>
                <div class="flex items-center gap-x-4 lg:gap-x-6">
                    <button type="button" class="hidden -m-2.5 p-2.5 text-gray-400 hover:text-gray-400">
                        <span class="sr-only">View notifications</span>
                        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                        </svg>
                    </button>



                    <!-- Profile dropdown -->
                    <div class="relative">
                        <button type="button" onclick="$('#user-submenu').toggleClass('hidden');" class="-m-1.5 flex items-center p-1.5 hover:bg-gray-300 rounded-lg" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="sr-only">Open user menu</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>

                            <span class="hidden lg:flex lg:items-center">
                                <span class="ml-4 text-sm text-gray-400" aria-hidden="true"><?= $_SESSION['user']['name'] ?></span>
                                <svg class="ml-2 size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </button>


                        <div id="user-submenu" class="hidden  absolute right-0 z-10 mt-2.5 w-64 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <!-- Active: "bg-gray-50 outline-none", Not Active: "" -->
                            <a href="<?= APP_URL ?>profile" class="block px-3 py-1 text-sm text-gray-900 hover:font-bold hover:text-black" role="menuitem" tabindex="-1" id="user-menu-item-0"><?= _('User Profile') ?></a>
                            <a href="<?= APP_URL ?>actionLogout" class="block px-3 py-1 text-sm text-gray-900 hover:font-bold hover:text-black" role="menuitem" tabindex="-1" id="user-menu-item-1">
                                <?= _('Log Out') ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?php if (!empty($_SESSION['errors']) and count($_SESSION['errors']) > 0): ?>


            <div id="modal-alert" class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <div class="relative transform overflow-hidden rounded-lg bg-gray-200 px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                            <div class="sm:flex sm:items-start">
                                <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-sky-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <svg class="h-6 w-6 text-sky-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                    <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title"><?= APP_NAME ?> </h3>
                                    <div class="mt-2">
                                        <?php foreach ($_SESSION['errors'] as  $v): ?>
                                            <p class="text-sm text-gray-400"><?= $v ?></p>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                <button type="button" onclick="$('#modal-alert').addClass('hidden');" class="inline-flex w-full justify-center rounded-md bg-sky-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-sky-500 sm:ml-3 sm:w-auto">Cerrar</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        <?php endif; ?>

        <?php if (!empty($_SESSION['alerts']) and count($_SESSION['alerts']) > 0): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3  rounded-xl mb-2 relative" role="alert">
                <?php foreach ($_SESSION['alerts'] as $v): ?>
                    <span class="block sm:inline"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 inline">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                        </svg>

                        <?= $v ?></span><br>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <main class="py-5 bg-white rounded-tl-[17px] shadow-lg min-h-screen">
            <div class="px-8">
                <!-- This is closed in footer -->
