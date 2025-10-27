<!-- PRICING -->
<div id="pricing" class="bg-gray-50 py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-4xl text-center">
            <h2 class="text-base/7 font-semibold text-blue-700"><?= _('Super SaaS') ?></h2>
            <p class="mt-2 text-balance text-5xl font-semibold tracking-tight text-gray-800 sm:text-6xl"><?= _('Pricing') ?></p>
        </div>
        <p class="mx-auto mt-6 max-w-2xl text-pretty text-center text-lg font-medium text-gray-500 sm:text-xl/8"><?= _('365 días al año, 24 horas al día, fines de semana, noches y festivos incluidos. Sin altas en la seguridad social ni permanencia, puedes cancelar tu cuenta cuando quieras.') ?></p>

        <div class="isolate mx-auto mt-10 grid max-w-md grid-cols-1 gap-8 lg:mx-0 lg:max-w-none lg:grid-cols-3">
            <!-- Plan Base -->
            <div class="rounded-3xl bg-white p-8 ring-1 ring-white/10 xl:p-10">
                <div class="flex items-center justify-between gap-x-4">
                    <h3 id="tier-freelancer" class="text-lg/8 font-semibold text-gray-800"><?= _('Base') ?></h3>
                </div>
                <p class="mt-4 text-sm/6 text-gray-700"><?= _('Escribe y envía tu última respuesta por email, ya eres libre') ?></p>
                <p class="mt-6 flex items-baseline gap-x-1">
                    <span class="text-4xl font-semibold tracking-tight text-gray-800">39€</span>
                    <span class="text-sm/6 font-semibold text-gray-300">/month</span>
                </p>
                <a href="<?= LANDING_URL ?>signup" aria-describedby="tier-freelancer" class="mt-6 block rounded-md bg-blue-900 px-3 py-2 text-center text-sm/6 font-semibold text-gray-100 hover:bg-blue-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white"><?= _('Empezar ahora »') ?></a>
                <ul role="list" class="mt-8 space-y-3 text-sm/6 text-gray-600 xl:mt-10">
                    <li class="flex gap-x-3"> <svg class="h-6 w-5 flex-none text-gray-800" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                        </svg><?= _('Hasta 350 emails gestionados') ?></li>
                    <li class="flex gap-x-3"> <svg class="h-6 w-5 flex-none text-gray-800" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                        </svg><?= _('24h / Todos los idiomas') ?></li>
                    <li class="flex gap-x-3"> <svg class="h-6 w-5 flex-none text-gray-800" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                        </svg><?= _('Escenarios y tipos de respuesta ilimitados') ?></li>
                    <li class="flex gap-x-3"> <svg class="h-6 w-5 flex-none text-gray-800" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                        </svg><?= _('Productos y Servicios') ?></li>
                    <li class="flex gap-x-3"> <svg class="h-6 w-5 flex-none text-gray-800" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                        </svg><?= _('Integración Google Calendar') ?></li>
                    <li class="flex gap-x-3"> <svg class="h-6 w-5 flex-none text-gray-800" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                        </svg><?= _('Integración API GET/POST') ?></li>
                </ul>
            </div>

            <!-- Plan Startup -->
            <div class="rounded-3xl bg-white p-8 ring-2 ring-blue-900 xl:p-10">
                <div class="flex items-center justify-between gap-x-4">
                    <h3 id="tier-startup" class="text-lg/8 font-semibold text-gray-800"><?= _('Startup') ?></h3>
                    <p class="rounded-full bg-blue-900 px-2.5 py-1 text-xs/5 font-semibold text-gray-100"><?= _('Más popular') ?></p>
                </div>
                <p class="mt-4 text-sm/6 text-gray-700"><?= _('Maneja documentos, adjuntos y más capacidad') ?></p>
                <p class="mt-6 flex items-baseline gap-x-1">
                    <span class="text-4xl font-semibold tracking-tight text-gray-800">79€</span>
                    <span class="text-sm/6 font-semibold text-gray-300">/month</span>
                </p>
                <a href="<?= LANDING_URL ?>signup" aria-describedby="tier-startup" class="mt-6 block rounded-md bg-blue-900 px-3 py-2 text-center text-sm/6 font-semibold text-gray-100 shadow-sm hover:bg-blue-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-900"><?= _('Empezar ahora »') ?></a>
                <ul role="list" class="mt-8 space-y-3 text-sm/6 text-gray-600 xl:mt-10">
                    <li class="flex gap-x-3"> <svg class="h-6 w-5 flex-none text-gray-800" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                        </svg><?= _('Hasta 1000 emails gestionados') ?></li>
                    <li class="flex gap-x-3"> <svg class="h-6 w-5 flex-none text-gray-800" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                        </svg><?= _('24h / Todos los idiomas') ?></li>
                    <li class="flex gap-x-3"> <svg class="h-6 w-5 flex-none text-gray-800" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                        </svg><?= _('Escenarios ilimitados') ?></li>
                    <li class="flex gap-x-3"> <svg class="h-6 w-5 flex-none text-gray-800" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                        </svg><?= _('Productos y Servicios') ?></li>
                    <li class="flex gap-x-3"> <svg class="h-6 w-5 flex-none text-gray-800" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                        </svg><?= _('Múltiples integraciones') ?></li>
                    <li class="flex gap-x-3"> <svg class="h-6 w-5 flex-none text-gray-800" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                        </svg><?= _('Integración API GET/POST') ?></li>
                    <li class="flex gap-x-3"> <svg class="h-6 w-5 flex-none text-gray-800" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                        </svg><?= _('Documentos') ?></li>
                    <li class="flex gap-x-3"> <svg class="h-6 w-5 flex-none text-gray-800" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                        </svg><?= _('Procesamiento de archivos adjuntos') ?></li>
                    <li class="flex gap-x-3"> <svg class="h-6 w-5 flex-none text-gray-800" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                        </svg><?= _('Automatizaciones Email') ?></li>
                </ul>
            </div>

            <!-- Plan Enterprise -->
            <div class="rounded-3xl p-8 ring-1 bg-white ring-white/10 xl:p-10">
                <div class="flex items-center justify-between gap-x-4">
                    <h3 id="tier-enterprise" class="text-lg/8 font-semibold text-gray-800"><?= _('Enterprise') ?></h3>
                </div>
                <p class="mt-4 text-sm/6 text-gray-700"><?= _('Plan a medida para empresas') ?></p>
                <p class="mt-6 flex items-baseline gap-x-1"></p>
                <a href="<?= LANDING_URL ?>contact" aria-describedby="tier-enterprise" class="mt-6 block rounded-md bg-blue-900 px-3 py-2 text-center text-sm/6 font-semibold text-gray-100 hover:bg-blue-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white"><?= _('Contacta con nosotros') ?></a>
                <ul role="list" class="mt-8 space-y-3 text-sm/6 text-gray-600 xl:mt-10">
                    <li class="flex gap-x-3"> <svg class="h-6 w-5 flex-none text-gray-800" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                        </svg><?= _('Emails gestionados sin límite') ?></li>
                    <li class="flex gap-x-3"> <svg class="h-6 w-5 flex-none text-gray-800" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                        </svg><?= _('Varios buzones de correo') ?></li>
                    <li class="flex gap-x-3"> <svg class="h-6 w-5 flex-none text-gray-800" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                        </svg><?= _('Gestión de departamentos') ?></li>
                    <li class="flex gap-x-3"> <svg class="h-6 w-5 flex-none text-gray-800" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                        </svg><?= _('Soporte y atención prioritaria') ?></li>
                    <li class="flex gap-x-3"> <svg class="h-6 w-5 flex-none text-gray-800" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                        </svg><?= _('Informes y estadísticas avanzadas') ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>