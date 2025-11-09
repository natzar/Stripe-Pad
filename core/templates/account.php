<div class="mx-auto mb-5">

  <nav class="flex mb-4" aria-label="Breadcrumb">
    <ol role="list" class="flex items-center space-x-4">
      <li>
        <div>
          <a href="<?= APP_URL ?>" class="text-gray-600 hover:text-gray-500">
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
          <a href="<?= APP_URL ?>account" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"><?= _('Account Settings') ?></a>
        </div>
      </li>
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

<div class="mx-auto grid gap-6">
  <div class="rounded-2xl bg-white shadow p-6">
    <div class="flex items-center justify-between">
      <div>
        <h2 class="text-lg font-semibold text-gray-900"><?= _('Billing Portal') ?></h2>
        <p class="text-sm text-gray-500"><?= _('Update payment methods, download invoices or cancel your plan directly from Stripe.') ?></p>
      </div>
      <a href="/account" target="_blank" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-500">
        <?= _('Open Stripe Portal') ?>
      </a>
    </div>
    <?php if (!empty($invoices)): ?>
      <ul class="mt-6 divide-y divide-gray-100">
        <?php foreach (array_slice($invoices, 0, 3) as $invoice): ?>
          <li class="flex items-center justify-between py-4">
            <div>
              <p class="text-sm font-medium text-gray-900">#<?= $invoice['invoicesId'] ?></p>
              <p class="text-xs text-gray-500"><?= $invoice['cart'] ?></p>
            </div>
            <div class="text-right">
              <p class="text-sm font-semibold text-gray-900"><?= number_format($invoice['total'], 2) ?>&euro;</p>
              <p class="text-xs text-gray-500"><?= date('M d, Y', strtotime($invoice['created'])) ?></p>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      <p class="mt-6 text-sm text-gray-500"><?= _('No invoices have been generated yet.') ?></p>
    <?php endif; ?>
  </div>

  <div class="rounded-2xl bg-white shadow p-6">
    <div class="flex items-center justify-between">
      <h2 class="text-lg font-semibold text-gray-900"><?= _('Subscriptions') ?></h2>
      <span class="text-sm text-gray-500"><?= count($subscriptions) ?> <?= _('active record(s)') ?></span>
    </div>
    <div class="mt-4 overflow-x-auto">
      <table class="min-w-full table-auto text-left">
        <thead class="bg-gray-50 text-xs font-semibold uppercase tracking-wide text-gray-500">
          <tr>
            <th class="px-4 py-2"><?= _('Started') ?></th>
            <th class="px-4 py-2"><?= _('Plan') ?></th>
            <th class="px-4 py-2"><?= _('Status') ?></th>
            <th class="px-4 py-2"><?= _('Renews') ?></th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
          <?php if (!empty($subscriptions)): ?>
            <?php foreach ($subscriptions as $subscription): ?>
              <tr>
                <td class="px-4 py-2"><?= date('M d, Y', strtotime($subscription['start_date'] ?? $subscription['created'])) ?></td>
                <td class="px-4 py-2"><?= $subscription['name'] ?? _('Plan') ?></td>
                <td class="px-4 py-2">
                  <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-semibold <?= ($subscription['active'] ?? 0) ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' ?>">
                    <?= ($subscription['active'] ?? 0) ? _('Active') : _('Inactive') ?>
                  </span>
                </td>
                <td class="px-4 py-2"><?= isset($subscription['end_date']) ? date('M d, Y', strtotime($subscription['end_date'])) : _('—') ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="4" class="px-4 py-4 text-center text-gray-500"><?= _('No subscriptions found') ?></td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="rounded-2xl bg-white shadow p-6">
    <div class="flex items-center justify-between">
      <h2 class="text-lg font-semibold text-gray-900"><?= _('Invoices') ?></h2>
      <span class="text-sm text-gray-500"><?= count($invoices) ?> <?= _('document(s)') ?></span>
    </div>
    <div class="mt-4 overflow-x-auto">
      <table class="min-w-full table-auto text-left">
        <thead class="bg-gray-50 text-xs font-semibold uppercase tracking-wide text-gray-500">
          <tr>
            <th class="px-4 py-2"><?= _('Invoice') ?></th>
            <th class="px-4 py-2"><?= _('Issued') ?></th>
            <th class="px-4 py-2"><?= _('Total') ?></th>
            <th class="px-4 py-2"><?= _('Download') ?></th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
          <?php if (!empty($invoices)): ?>
            <?php foreach ($invoices as $invoice): ?>
              <tr>
                <td class="px-4 py-2 font-medium text-gray-900">#<?= $invoice['invoicesId'] ?></td>
                <td class="px-4 py-2"><?= date('M d, Y', strtotime($invoice['created'])) ?></td>
                <td class="px-4 py-2"><?= number_format($invoice['total'], 2) ?>&euro;</td>
                <td class="px-4 py-2">
                  <?php if (!empty($invoice['pdf_path'])): ?>
                    <a target="_blank" href="https://app.phpninja.net/uploads/users/<?= $invoice['pdf_path'] ?>" class="text-indigo-600 hover:text-indigo-500 font-semibold"><?= _('PDF') ?></a>
                  <?php else: ?>
                    <span class="text-gray-400">—</span>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="4" class="px-4 py-4 text-center text-gray-500"><?= _('No invoices found') ?></td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
