<div class="max-w-2xl mt-5 mx-auto">
    <form method="post" class="pt-10 bg-blue pb-10 p-6 rounded-2xl space-y-6 text-gray-500" action="<?= APP_DOMAIN ?>demo_apply">
        <h2 class=" text-3xl border-b-4 border-yellow-400 pb-4 font-semibold text-gray-900"><?= _('Demostración Personalizada') ?></h2>
        <p class=""><?= _('Rellene este formulario y evaluaremos si su caso encaja con la prueba gratuita. Se configurará un agente para su negocio para que pueda probar el servicio durante 40 días <u>sin coste</u>') ?></p>

        <!-- Tipo de negocio -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1" for="business_type"><?= _('¿Qué tipo de negocio tienes?') ?></label>
            <select id="business_type" name="business_type" class="w-full border border-gray-300 rounded-lg p-2">
                <option value=""><?= _('Selecciona una opción') ?></option>
                <option value="tienda"><?= _('Tienda online') ?></option>
                <option value="alojamiento"><?= _('Alojamiento turístico') ?></option>
                <option value="clinica"><?= _('Clínica o consulta') ?></option>
                <option value="freelance"><?= _('Freelancer o autónomo') ?></option>
                <option value="otro"><?= _('Otro') ?></option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1" for="url"><?= _('Sitio Web') ?></label>
            <input type="url" value="https://" id="url" name="url" required class="w-full border border-gray-300 rounded-lg p-2" placeholder="<?= _('https://domain.com') ?>">
        </div>

        <!-- Correos por día -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1" for="emails_per_day"><?= _('¿Cuántos correos recibes al día?') ?></label>
            <input type="number" id="emails_per_day" name="emails_per_day" min="0" class="w-full border border-gray-300 rounded-lg p-2" placeholder="<?= _('Ej: 30') ?>">
        </div>

        <!-- Tipo de mensajes -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1" for="message_types"><?= _('¿Qué tipo de mensajes te quitan más tiempo o son más repetitivos o comunes?') ?></label>
            <textarea id="message_types" name="message_types" rows="4" class="w-full border border-gray-300 rounded-lg p-2" placeholder="<?= _('Reservas, preguntas frecuentes, incidencias...') ?>"></textarea>
        </div>

        <!-- Email de contacto -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1" for="email"><?= _('Tu email') ?></label>
            <input type="email" id="email" name="email" required class="w-full border border-gray-300 rounded-lg p-2" placeholder="<?= _('tucorreo@ejemplo.com') ?>">
        </div>

        <!-- Botón de enviar -->
        <div class="">
            <button type="submit" class="bg-yellow-500 font-semibold text-sm text-white px-6 py-3 rounded-lg hover:bg-yellow-800 hover:text-white transition"><?= _('Solicitar Demostración') ?></button>
            <p class="text-sm mt-3"><?= _('Recibirá una confirmación en 24-48h. Email de bienvenida con accesos a su cuenta y su agente de soporte listo para usarse.') ?></p>
        </div>

        <input type="hidden" name="source" value="">
        <? include dirname(__FILE__) . "/../common/forms-rgpd.php"; ?>
    </form>
</div>