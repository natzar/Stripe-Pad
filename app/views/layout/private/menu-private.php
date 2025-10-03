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
                                        <a href="<?= APP_DOMAIN ?>" class="group flex gap-x-3 rounded-md bg-gray-50 p-2 text-sm text-blue-600">
                                            <svg class="size-6 shrink-0 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                            </svg>
                                            Inicio
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


            <script>
                function togglePopup() {
                    const popup = document.getElementById("popup");
                    popup.classList.toggle("hidden");
                }
            </script>


            <!-- Selector -->
            <div class="mt-2 relative inline-block text-left">
                <button onclick="togglePopup()" class="flex text-left items-center space-x-2 bg-gray-200 p-2 rounded-lg">
                    <img src="<?= APP_LOGO ?>" alt="Php Ninja" class="w-6 h-6 rounded-full" />
                    <span class="text-left text-sm text-gray-800 font-semibold"><?= $_SESSION['agent']['agent_organization'] ?></span>
                    <svg class="w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Popup -->
                <div id="popup" class="absolute left-0 w-48 mt-2 origin-top-left  rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden">
                    <div class="py-1">

                        <? foreach ($_SESSION['user']['agents'] as $c): ?>
                            <a href="<?= APP_DOMAIN ?>app_change_account/<?= $c['agentsId'] ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:font-semibold"><?= $c['agent_organization'] ?></a>

                        <? endforeach; ?>
                        <a href="<?= APP_DOMAIN ?>app_new_account" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Añadir nuevo Agente ...</a>
                    </div>
                </div>
            </div>

            <nav id="sidebar" class="pt-5">
                <ul class="-mx-2 space-y-1">
                    <li>
                        <!-- Current: "bg-gray-50 text-blue-600", Default: "text-gray-700 hover:text-blue-600 hover:bg-gray-50" -->
                        <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                            <svg class="size-6 " fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            Inicio
                        </a>
                    </li>

                    <li class="mb-5">
                        <a href="<?= APP_DOMAIN ?>app_agent" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                            </svg>

                            Agente
                        </a>

                    </li>
                    <li class="mb-5">
                        <a href="<?= APP_DOMAIN ?>app_scenarios" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                            </svg>

                            Escenarios
                        </a>
                    </li>
                    <li>
                        <div class="text-xs/6 font-semibold text-gray-400">Conversaciones por Email</div>
                    </li>
                    <li class="mb-5">
                        <a href="<?= APP_DOMAIN ?>app_conversations/unknown" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                            </svg>
                            Necesitan atención (<?= $total_unknown ?>)
                        </a>
                    </li>
                    <li class="mb-5">
                        <a href="<?= APP_DOMAIN ?>app_conversations" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.75H6.912a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859M12 3v8.25m0 0-3-3m3 3 3-3" />
                            </svg>

                            Recibidos (<?= $total_inbox ?>)
                        </a>
                    </li>

                    <li class="mb-5">
                        <a href="<?= APP_DOMAIN ?>app_conversations/out" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                            </svg>

                            A Enviar (<?= $total_out ?>)
                        </a>
                    </li>

                    <li class="mb-5">
                        <a href="<?= APP_DOMAIN ?>app_conversations/sent" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                            </svg>

                            Enviados (<?= $total_sent ?>)
                        </a>
                    </li>
                    <li class="mb-5">
                        <a href="<?= APP_DOMAIN ?>app_conversations/archived" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                            </svg>

                            Archivados (<?= $total_archived ?>)
                        </a>
                    </li>
                    <li class="mb-5">
                        <a href="<?= APP_DOMAIN ?>app_conversations/spam" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>

                            SPAM (<?= $total_spam ?>)
                        </a>
                    </li>





                    <!-- 

                    <li class="mb-5">
                        <a href="<?= APP_DOMAIN ?>app_tags" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                            </svg>
                            Etiquetas
                        </a>
                    </li> -->


                    <li>
                        <div class="text-xs/6 font-semibold text-gray-400">Bases de datos</div>
                    </li>



                    <li class="mb-5">
                        <a href="<?= APP_DOMAIN ?>app_contacts" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                            </svg>


                            Contactos (<?= $total_contacts ?>)
                        </a>
                    </li>
                    <!-- <li class="mb-5">
                        <a href="<?= APP_DOMAIN ?>app_calendar" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                            </svg>
                            Calendario
                        </a>
                    </li>
                    <li class="mb-5">
                        <a href="<?= APP_DOMAIN ?>app_documents" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                            </svg>

                            Documentos
                        </a>
                    </li> -->

                    <!-- <li class="mb-5">
                        <a href="<?= APP_DOMAIN ?>app_faq" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3" />
                            </svg> Preguntas y Respuestas
                        </a>
                    </li> -->
                    <li>
                        <div class="text-xs/6 font-semibold text-gray-400">Configuración</div>
                    </li>
                    <li>

                        <a href="<?= APP_DOMAIN ?>app_simulator" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>

                            Simulador
                        </a>
                    </li>

                    <!-- <li class="mb-5">
                        <a href="<?= APP_DOMAIN ?>app_templates" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75 2.25 12l4.179 2.25m0-4.5 5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0 4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0-5.571 3-5.571-3" />
                            </svg>

                            E-mails automáticos
                        </a>
                    </li>


                    <li class="mb-5">
                        <a href="<?= APP_DOMAIN ?>app_integrations" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                            </svg>
                            Integraciones
                        </a>
                    </li> -->
                    <li class="mb-5">
                        <a href="<?= APP_DOMAIN ?>app_config_inbox" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>


                            Conexión E-mail
                        </a>
                    </li>
                    <!-- <li class="mb-5">
                        <a href="<?= APP_DOMAIN ?>app_config_inbox" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                            </svg>

                            Usuarios con acceso
                        </a>
                    </li> -->
                    <li>
                        <!-- Current: "bg-gray-50 text-blue-600", Default: "text-gray-700 hover:text-blue-600 hover:bg-gray-50" -->
                        <a href="<?= APP_DOMAIN ?>profile" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>


                            Preferencias Usuario
                        </a>
                    </li>
                    <li>
                        <!-- Current: "bg-gray-50 text-blue-600", Default: "text-gray-700 hover:text-blue-600 hover:bg-gray-50" -->
                        <a href="<?= APP_DOMAIN ?>contact" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
                            </svg>


                            Ayuda
                        </a>
                    </li>

                    <? if ($_SESSION['user']['group'] == 'superadmin') : ?>
                        <li class="mt-5 pt-10">
                            <div class="text-xs/6 font-semibold text-gray-400">Superadmin's only</div>
                        </li>
                        <li>

                            <ul role="list" class=" space-y-1">


                                <li>
                                    <!-- Current: "bg-gray-50 text-blue-600", Default: "text-gray-400 hover:text-blue-600 hover:bg-gray-50" -->
                                    <a href="<?= APP_DOMAIN ?>superadmin" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                                        <svg class="size-6 shrink-0 text-gray-400 group-hover:text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                        </svg>
                                        Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= APP_DOMAIN ?>table/blog" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0 text-gray-400 group-hover:text-blue-600">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                                        </svg>


                                        Blog
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= APP_DOMAIN ?>table/users" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                                        <svg class="size-6 shrink-0 text-gray-400 group-hover:text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                        </svg>
                                        Users
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= APP_DOMAIN ?>table/products" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                                        <svg class="size-6 shrink-0 text-gray-400 group-hover:text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                                        </svg>
                                        Products
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= APP_DOMAIN ?>table/subscriptions" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                                        <svg class="size-6 shrink-0 text-gray-400 group-hover:text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                        </svg>
                                        Subscriptions
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= APP_DOMAIN ?>table/invoices" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">
                                        <svg class="size-6 shrink-0 text-gray-400 group-hover:text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                                        </svg>
                                        Payments
                                    </a>
                                </li>

                                <li>
                                    <a href="<?= APP_DOMAIN ?>table/crons" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 14.25h13.5m-13.5 0a3 3 0 0 1-3-3m3 3a3 3 0 1 0 0 6h13.5a3 3 0 1 0 0-6m-16.5-3a3 3 0 0 1 3-3h13.5a3 3 0 0 1 3 3m-19.5 0a4.5 4.5 0 0 1 .9-2.7L5.737 5.1a3.375 3.375 0 0 1 2.7-1.35h7.126c1.062 0 2.062.5 2.7 1.35l2.587 3.45a4.5 4.5 0 0 1 .9 2.7m0 0a3 3 0 0 1-3 3m0 3h.008v.008h-.008v-.008Zm0-6h.008v.008h-.008v-.008Zm-3 6h.008v.008h-.008v-.008Zm0-6h.008v.008h-.008v-.008Z" />
                                        </svg> Cronjobs
                                    </a>
                                </li>

                                <li>
                                    <a href="<?= APP_DOMAIN ?>comingsoon" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                        </svg> Feedback Loop
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= APP_DOMAIN ?>comingsoon" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                                        </svg>
                                        SEO
                                    </a>
                                </li>

                                <li>
                                    <a href="<?= APP_DOMAIN ?>table/subscribers" class="group flex gap-x-3 rounded-md p-2 text-sm text-gray-800 hover:bg-gray-50 hover:text-blue-600">


                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                        </svg>


                                        Email Subscribers
                                    </a>
                                </li>






                            </ul>



                        </li>
                    <? endif; ?>

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
                            <a href="<?= APP_DOMAIN ?>profile" class="block px-3 py-1 text-sm text-gray-900 hover:font-bold hover:text-black" role="menuitem" tabindex="-1" id="user-menu-item-0"><?= _('Preferencias') ?></a>
                            <a href="<?= APP_DOMAIN ?>actionLogout" class="block px-3 py-1 text-sm text-gray-900 hover:font-bold hover:text-black" role="menuitem" tabindex="-1" id="user-menu-item-1">
                                <?= _('Cerrar Sesión') ?></a>
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
            <div class="px-4 ">
                <!-- This is closed in footer -->