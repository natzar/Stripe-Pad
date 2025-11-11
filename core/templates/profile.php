<div class="mx-auto mb-5">


  <nav class="flex mb-4" aria-label="Breadcrumb">
    <ol role="list" class="flex items-center space-x-4">
      <li>
        <div>
          <a href="<?= ADMIN_URL ?>" class="text-gray-600 hover:text-gray-500">
            <svg class="size-5 shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
              <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 0 1 1.414 0l7 7A1 1 0 0 1 17 11h-1v6a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6H3a1 1 0 0 1-.707-1.707l7-7Z" clip-rule="evenodd" />
            </svg>
            <span class="sr-only">Home</span>
          </a>
        </div>
      </li>
      <li>
        <div class="flex items-center">
          <svg class="size-5 shrink-0 text-gray-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
            <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
          </svg>
          <a href="<?= ADMIN_URL ?>" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"><?= $_SESSION['account']['account_name'] ?></a>
        </div>
      </li>
      <? if (isset($breadcrumb[0])): ?>
        <li>
          <div class="flex items-center">
            <svg class="size-5 shrink-0 text-gray-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
              <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
            </svg>
            <a href="<?= $breadcrumb[0]['url'] ?>" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"><?= $breadcrumb[0]['label'] ?></a>
          </div>
        </li>
      <? endif; ?>
      <? if (isset($breadcrumb[1])): ?>
        <li>
          <div class="flex items-center">
            <svg class="size-5 shrink-0 text-gray-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
              <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
            </svg>
            <a href="<?= $breadcrumb[1]['url'] ?>" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700" aria-current="page"><?= $breadcrumb[0]['label'] ?></a>
          </div>
        </li>
      <? endif; ?>
      <? if (isset($breadcrumb[2])): ?>
        <li>
          <div class="flex items-center">
            <svg class="size-5 shrink-0 text-gray-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
              <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
            </svg>
            <a href="<?= $breadcrumb[2]['url'] ?>" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700" aria-current="page"><?= $breadcrumb[2]['label'] ?></a>
          </div>
        </li>
      <? endif; ?>
    </ol>
  </nav>


  <div class="flex items-center space-x-4">
    <img src="<?= APP_LOGO ?>" alt="Logo" class="w-12 h-12 rounded-full" />
    <div>
      <p class="text-pretty text-3xl font-semibold tracking-tight text-gray-900 sm:text-4xl"><?= $SEO_TITLE ?></p>
      <p class="text-gray-600 mt-1 text-base leading-6 max-w-3xl"><?= $SEO_DESCRIPTION ?></p>
    </div>
  </div>
</div>



<div class="mx-auto space-y-10">
  <!-- Profile data -->
  <section class="rounded-2xl bg-white shadow p-6 mb-5">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
      <div>
        <p class="text-sm uppercase tracking-wide text-sky-600"><?= _('Perfil') ?></p>
        <h2 class="text-2xl font-semibold text-gray-900"><?= _('Datos de Usuario') ?></h2>
        <p class="text-sm text-gray-500"><?= _('Actualiza la información básica de tu cuenta y facturación.') ?></p>
      </div>
    </div>
    <form action="<?= APP_URL ?>actionUpdateUser" method="POST" class="space-y-4">
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="email" value="<?= $user['email'] ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required="required" disabled="disabled">
        <p class="text-sm text-gray-500"><?= _('Importante para todas las notificaciones y alertas. Este email no se puede modificar, contacta con ventas si necesitas recibir las notificaciones en otras cuentas de email') ?></p>
      </div>
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700"><?= _('Nombre') ?></label>
        <input type="text" name="name" value="<?= $user['name'] ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required="required">
      </div>
      <div>
        <label for="language" class="block text-sm font-medium text-gray-700"><?= _('Idioma') ?></label>
        <select id="language" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
          <option value="en">English (US)</option>
          <option value="es" selected>Spanish (ES)</option>
          <option value="fr">Française (FR)</option>
        </select>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label for="company" class="block text-sm font-medium text-gray-700"><?= _('Organización') ?></label>
          <input type="text" name="name" value="<?= $user['name'] ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <div>
          <label for="vat" class="block text-sm font-medium text-gray-700"><?= _('ID / VAT / CIF / NIF (Taxes)') ?></label>
          <input required="required" type="text" name="nif" value="<?= $user['tax_id'] ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
      </div>
      <div>
        <label for="address" class="block text-sm font-medium text-gray-700"><?= _('Dirección') ?></label>
        <input type="text" name="address" value="<?= $user['address'] ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
      </div>
      <div class="pt-4">
        <input type="submit" class="cursor-pointer rounded-full bg-gray-900 text-white hover:bg-gray-800 px-5 py-3 text-sm font-semibold" value="<?= _('Update Profile') ?>">
      </div>
    </form>
  </section>

  <!-- Password -->
  <section class="rounded-2xl bg-white shadow p-6 mb-5">
    <div class="mb-6">
      <p class="text-sm uppercase tracking-wide text-sky-600"><?= _('Seguridad') ?></p>
      <h2 class="text-2xl font-semibold text-gray-900"><?= _('Change your password') ?></h2>
      <p class="text-sm text-gray-500"><?= _('Mantén tu cuenta protegida actualizando la contraseña con regularidad.') ?></p>
    </div>
    <form action="<?= APP_URL ?>actionUpdateuser" method="POST" class="space-y-4">
      <div>
        <label for="current_password" class="block text-sm font-medium text-gray-700"><?= _('Current Password') ?></label>
        <input type="password" name="current_password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
      </div>
      <div>
        <label for="new_password" class="block text-sm font-medium text-gray-700"><?= _('New Password') ?></label>
        <input type="password" name="new_password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
      </div>
      <div>
        <label for="confirm_password" class="block text-sm font-medium text-gray-700"><?= _('Repeat new Password') ?></label>
        <input type="password" name="confirm_password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
      </div>
      <div class="pt-4">
        <input type="submit" class="rounded-full bg-gray-900 text-white hover:bg-gray-800 px-5 py-3 text-sm font-semibold cursor-pointer" value="<?= _('Update Password') ?>">
      </div>
    </form>
  </section>

  <!-- Notifications -->
  <section class="rounded-2xl bg-white shadow p-6 mb-5">
    <div class="mb-4">
      <p class="text-sm uppercase tracking-wide text-sky-600"><?= _('Comunicaciones') ?></p>
      <h2 class="text-2xl font-semibold text-gray-900"><?= _('Notificaciones y avisos') ?></h2>
      <p class="text-sm text-gray-500"><?= _('Selecciona cómo deseas recibir resúmenes y recordatorios.') ?></p>
    </div>
    <div class="space-y-4">
      <div class="flex items-start gap-3">
        <input type="checkbox" id="daily_newsletter" name="daily_newsletter" value="1" class="mt-1 form-checkbox" checked>
        <label for="daily_newsletter" class="text-sm text-gray-700"><?= _('Recibir E-mail diario con el resumen de conversaciones mantenidas') ?></label>
      </div>
      <div class="flex items-start gap-3">
        <input type="checkbox" id="weekly_newsletter" name="weekly_newsletter" value="1" class="mt-1 form-checkbox" checked>
        <label for="weekly_newsletter" class="text-sm text-gray-700"><?= _('Recibir E-mail semanal con el resumen de temas más repetidos') ?></label>
      </div>
    </div>
  </section>

  <!-- Access -->
  <section class="rounded-2xl bg-white shadow p-6 mb-5">
    <div class="mb-4">
      <p class="text-sm uppercase tracking-wide text-sky-600"><?= _('Equipo') ?></p>
      <h2 class="text-2xl font-semibold text-gray-900"><?= _('Acceso y permisos') ?></h2>
      <p class="text-sm text-gray-500"><?= _('Consulta las cuentas asociadas a este user.') ?></p>
    </div>
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><?= _('Cuenta') ?></th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><?= _('Acceso') ?></th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
          <? foreach ($_SESSION['user']['accounts'] as $account): ?>
            <tr>
              <td class="px-4 py-3 text-sm text-gray-900"><?= $account['account_name'] ?></td>
              <td class="px-4 py-3 text-sm text-gray-500">
                <? if ($_SESSION['user']['usersId'] == $account['usersId']) echo 'Admin';
                else echo 'Regular Access'; ?>
              </td>
            </tr>
          <? endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>

  <!-- Delete account -->
  <section class="rounded-2xl bg-white shadow p-6 mb-5">
    <div class="mb-4">
      <p class="text-sm uppercase tracking-wide text-red-600"><?= _('Privacidad') ?></p>
      <h2 class="text-2xl font-semibold text-gray-900"><?= _('Eliminar cuenta y datos personales') ?></h2>
      <p class="text-sm text-gray-500"><?= _('Esta acción es irreversible y eliminará todos los datos asociados a tu perfil.') ?></p>
    </div>
    <form action="<?= APP_URL ?>actionDeleteAccount" method="POST" class="space-y-4">
      <p class="text-sm text-gray-600">
        <?= _('Confirma que deseas cerrar tu cuenta y borrar definitivamente tus datos personales. Recibirás una notificación cuando el proceso termine.') ?>
      </p>
      <label class="inline-flex items-center gap-2 text-sm text-gray-700">
        <input type="checkbox" name="confirm_delete" value="1" required class="form-checkbox text-red-600">
        <?= _('Entiendo que esta operación no se puede deshacer.') ?>
      </label>
      <div class="pt-4">
        <button type="submit" class="rounded-full bg-red-600 text-white hover:bg-red-700 px-5 py-3 text-sm font-semibold">
          <?= _('Eliminar definitivamente mi cuenta') ?>
        </button>
      </div>
    </form>
  </section>
</div>