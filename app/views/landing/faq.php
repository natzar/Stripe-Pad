<div class="bg-white">
    <div class="mx-auto max-w-7xl px-6 py-24 sm:py-32 lg:px-8 lg:py-40">
        <div class="mx-auto max-w-4xl">
            <h2 class="text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl"><?= _('Preguntas frecuentes'); ?></h2>
            <dl class="mt-16 divide-y divide-gray-900/10">

                <!-- 1 -->
                <div class="py-6 first:pt-0 last:pb-0">
                    <dt>
                        <button type="button" class="flex w-full items-start justify-between text-left text-gray-900" aria-controls="faq-0" aria-expanded="false">
                            <span class="text-base/7 font-semibold"><?= _('¿Emilio (agente de IA) responde solo?'); ?></span>
                            <span class="ml-6 flex h-7 items-center">
                                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                </svg>
                                <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                                </svg>
                            </span>
                        </button>
                    </dt>
                    <dd class="mt-2 pr-12" id="faq-0">
                        <p class="text-base/7 text-gray-600"><?= _('Sí, gracias al algoritmo de inteligencia artificial que hemos diseñado, está capacitado para enviar respuestas automáticas según los escenarios de respuesta definidos. Sin embargo, también puedes activar el modo de prueba (Manual Mode) para comprobar cómo funciona antes de enviar las respuestas reales.'); ?></p>
                    </dd>
                </div>

                <!-- 2 -->
                <div class="py-6">
                    <dt>
                        <button type="button" class="flex w-full items-start justify-between text-left text-gray-900" aria-controls="faq-1" aria-expanded="false">
                            <span class="text-base/7 font-semibold"><?= _('¿Puedo personalizar las respuestas?'); ?></span>
                            <span class="ml-6 flex h-7 items-center">
                                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                </svg>
                                <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                                </svg>
                            </span>
                        </button>
                    </dt>
                    <dd class="mt-2 pr-12" id="faq-1">
                        <p class="text-base/7 text-gray-600"><?= _('Sí, puedes definir múltiples escenarios para personalizar totalmente las respuestas según las necesidades de tu empresa u organización. También puedes añadir ejemplos de respuesta, plantillas, elegir el tono de la comunicación, añadir una firma personalizada.'); ?></p>
                    </dd>
                </div>

                <!-- 3 -->
                <div class="py-6">
                    <dt>
                        <button type="button" class="flex w-full items-start justify-between text-left text-gray-900" aria-controls="faq-2" aria-expanded="false">
                            <span class="text-base/7 font-semibold"><?= _('¿Qué es un escenario?'); ?></span>
                            <span class="ml-6 flex h-7 items-center">
                                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                </svg>
                                <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                                </svg>
                            </span>
                        </button>
                    </dt>
                    <dd class="mt-2 pr-12" id="faq-2">
                        <p class="text-base/7 text-gray-600"><?= _('Un escenario es cada una de las posibles situaciones que Emilio se puede encontrar cuando quiere responder a tus emails, como por ejemplo una solicitud de reserva, la necesidad de reparar algo que no funciona de tu página web o un error 500 en tu API, etc.'); ?></p>
                    </dd>
                </div>

                <!-- 4 -->
                <div class="py-6">
                    <dt>
                        <button type="button" class="flex w-full items-start justify-between text-left text-gray-900" aria-controls="faq-3" aria-expanded="false">
                            <span class="text-base/7 font-semibold"><?= _('¿Cómo es el proceso de configuración?'); ?></span>
                            <span class="ml-6 flex h-7 items-center">
                                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                </svg>
                                <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                                </svg>
                            </span>
                        </button>
                    </dt>
                    <dd class="mt-2 pr-12" id="faq-3">
                        <p class="text-base/7 text-gray-600"><?= _('El proceso es muy sencillo, simplemente necesitamos saber los datos básicos de tu empresa u organización y el tipo de solicitudes que suelen hacer tus clientes. Con esta información, que podemos obtener desde tu página web y tu buzón de entrada, tenemos suficiente para personalizar tus escenarios de respuesta.'); ?></p>
                    </dd>
                </div>

                <!-- 5 -->
                <div class="py-6">
                    <dt>
                        <button type="button" class="flex w-full items-start justify-between text-left text-gray-900" aria-controls="faq-4" aria-expanded="false">
                            <span class="text-base/7 font-semibold"><?= _('¿Se me notifica acerca de los emails procesados?'); ?></span>
                            <span class="ml-6 flex h-7 items-center">
                                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                </svg>
                                <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                                </svg>
                            </span>
                        </button>
                    </dt>
                    <dd class="mt-2 pr-12" id="faq-4">
                        <p class="text-base/7 text-gray-600"><?= _('Sí, las notificaciones son personalizables y puedes escoger si recibirlas por email, WhatsApp o SMS. Puedes elegir que se te ponga en CC (copia) o en BCC (copia oculta) en todos los emails procesados, que se te notifique solo de los enviados por ciertos contactos, que se te envíe un resumen del contenido de cada correo o un resumen de la actividad diaria.'); ?></p>
                    </dd>
                </div>

                <!-- 6 -->
                <div class="py-6">
                    <dt>
                        <button type="button" class="flex w-full items-start justify-between text-left text-gray-900" aria-controls="faq-5" aria-expanded="false">
                            <span class="text-base/7 font-semibold"><?= _('¿Qué pasa si hay alguna consulta que Emilio (agente de IA) no sabe responder?'); ?></span>
                            <span class="ml-6 flex h-7 items-center">
                                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                </svg>
                                <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                                </svg>
                            </span>
                        </button>
                    </dt>
                    <dd class="mt-2 pr-12" id="faq-5">
                        <p class="text-base/7 text-gray-600"><?= _('En este caso se aplica un escenario específicamente diseñado para cubrir esta situación y que también puedes personalizar. Por defecto se notifica al remitente que se ha pasado la consulta al departamento correspondiente para que le dé una respuesta lo antes posible y se te envía a ti la solicitud para que puedas dar respuesta de forma manual. Una vez la respuesta esté en el sistema, Emilio la conocerá y será capaz de responder automáticamente en el futuro.'); ?></p>
                    </dd>
                </div>

                <!-- 7 -->
                <div class="py-6">
                    <dt>
                        <button type="button" class="flex w-full items-start justify-between text-left text-gray-900" aria-controls="faq-6" aria-expanded="false">
                            <span class="text-base/7 font-semibold"><?= _('¿Es compatible con Gmail, Outlook o el servidor de correo de mi web?'); ?></span>
                            <span class="ml-6 flex h-7 items-center">
                                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                </svg>
                                <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                                </svg>
                            </span>
                        </button>
                    </dt>
                    <dd class="mt-2 pr-12" id="faq-6">
                        <p class="text-base/7 text-gray-600"><?= _('Sí, el sistema accede a tu correo vía IMAP (Protocolo de Acceso a Mensajes de Internet), de forma segura, y puede procesar todos los emails que recibas.'); ?></p>
                    </dd>
                </div>

                <!-- 8 -->
                <div class="py-6">
                    <dt>
                        <button type="button" class="flex w-full items-start justify-between text-left text-gray-900" aria-controls="faq-7" aria-expanded="false">
                            <span class="text-base/7 font-semibold"><?= _('¿Qué integraciones están disponibles?'); ?></span>
                            <span class="ml-6 flex h-7 items-center">
                                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                </svg>
                                <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                                </svg>
                            </span>
                        </button>
                    </dt>
                    <dd class="mt-2 pr-12" id="faq-7">
                        <p class="text-base/7 text-gray-600"><?= _('Actualmente estamos trabajando con distintas plataformas para integrar Emilio. Aceptamos peticiones.'); ?></p>
                    </dd>
                </div>

                <!-- 9 -->
                <div class="py-6 last:pb-0">
                    <dt>
                        <button type="button" class="flex w-full items-start justify-between text-left text-gray-900" aria-controls="faq-8" aria-expanded="false">
                            <span class="text-base/7 font-semibold"><?= _('¿Tiene coste por uso?'); ?></span>
                            <span class="ml-6 flex h-7 items-center">
                                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                </svg>
                                <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                                </svg>
                            </span>
                        </button>
                    </dt>
                    <dd class="mt-2 pr-12" id="faq-8">
                        <p class="text-base/7 text-gray-600"><?= _('El precio de los packs depende de la cantidad de emails a procesar mensualmente. Es posible dar de alta varios agentes bajo la misma cuenta, mientras todos ellos no sumen la cantidad total del plan contratado, no habrá interrupción del servicio.'); ?></p>
                    </dd>
                </div>

            </dl>
        </div>
    </div>
</div>