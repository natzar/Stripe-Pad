<!-- PRICING -->
<div id="pricing" class="bg-gray-50 py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-4xl text-center">
            <p class="mt-2 text-balance text-5xl font-semibold tracking-tight text-gray-800 sm:text-6xl"><?= _('Pricing') ?></p>
        </div>
        <p class="mx-auto mt-6 max-w-2xl text-pretty text-center text-lg font-medium text-gray-500 sm:text-xl/8">
            <?= _('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sed justo ac velit pulvinar dictum non sit amet nulla.') ?>
        </p>

        <div class="isolate mx-auto mt-10 grid max-w-md grid-cols-1 gap-8 lg:mx-0 lg:max-w-none lg:grid-cols-3">
            <!-- Plan 1 -->
            <div class="rounded-3xl bg-white p-8 ring-1 ring-white/10 xl:p-10">
                <div class="flex items-center justify-between gap-x-4">
                    <h3 id="tier-basic" class="text-lg/8 font-semibold text-gray-800"><?= _('Basic') ?></h3>
                </div>
                <p class="mt-4 text-sm/6 text-gray-700"><?= _('Lorem ipsum dolor sit amet, consectetur adipiscing elit.') ?></p>
                <p class="mt-6 flex items-baseline gap-x-1">
                    <span class="text-4xl font-semibold tracking-tight text-gray-800">$9</span>
                    <span class="text-sm/6 font-semibold text-gray-300">/month</span>
                </p>
                <a href="#" aria-describedby="tier-basic" class="mt-6 block rounded-md bg-blue-900 px-3 py-2 text-center text-sm/6 font-semibold text-gray-100 hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-900"><?= _('Get started') ?></a>
                <ul role="list" class="mt-8 space-y-3 text-sm/6 text-gray-600 xl:mt-10">
                    <li class="flex gap-x-3">✔ <?= _('Lorem ipsum dolor sit amet') ?></li>
                    <li class="flex gap-x-3">✔ <?= _('Consectetur adipiscing elit') ?></li>
                    <li class="flex gap-x-3">✔ <?= _('Sed do eiusmod tempor') ?></li>
                </ul>
            </div>

            <!-- Plan 2 -->
            <div class="rounded-3xl bg-white p-8 ring-2 ring-blue-900 xl:p-10">
                <div class="flex items-center justify-between gap-x-4">
                    <h3 id="tier-pro" class="text-lg/8 font-semibold text-gray-800"><?= _('Pro') ?></h3>
                    <p class="rounded-full bg-blue-900 px-2.5 py-1 text-xs/5 font-semibold text-gray-100"><?= _('Most popular') ?></p>
                </div>
                <p class="mt-4 text-sm/6 text-gray-700"><?= _('Ut enim ad minim veniam, quis nostrud exercitation ullamco.') ?></p>
                <p class="mt-6 flex items-baseline gap-x-1">
                    <span class="text-4xl font-semibold tracking-tight text-gray-800">$29</span>
                    <span class="text-sm/6 font-semibold text-gray-300">/month</span>
                </p>
                <a href="#" aria-describedby="tier-pro" class="mt-6 block rounded-md bg-blue-900 px-3 py-2 text-center text-sm/6 font-semibold text-gray-100 shadow-sm hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-900"><?= _('Get started') ?></a>
                <ul role="list" class="mt-8 space-y-3 text-sm/6 text-gray-600 xl:mt-10">
                    <li class="flex gap-x-3">✔ <?= _('Lorem ipsum dolor sit amet') ?></li>
                    <li class="flex gap-x-3">✔ <?= _('Duis aute irure dolor in reprehenderit') ?></li>
                    <li class="flex gap-x-3">✔ <?= _('Excepteur sint occaecat cupidatat non proident') ?></li>
                    <li class="flex gap-x-3">✔ <?= _('Sunt in culpa qui officia deserunt') ?></li>
                </ul>
            </div>

            <!-- Plan 3 -->
            <div class="rounded-3xl bg-white p-8 ring-1 ring-white/10 xl:p-10">
                <div class="flex items-center justify-between gap-x-4">
                    <h3 id="tier-enterprise" class="text-lg/8 font-semibold text-gray-800"><?= _('Enterprise') ?></h3>
                </div>
                <p class="mt-4 text-sm/6 text-gray-700"><?= _('Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.') ?></p>
                <a href="#" aria-describedby="tier-enterprise" class="mt-6 block rounded-md bg-blue-900 px-3 py-2 text-center text-sm/6 font-semibold text-gray-100 hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-900"><?= _('Contact us') ?></a>
                <ul role="list" class="mt-8 space-y-3 text-sm/6 text-gray-600 xl:mt-10">
                    <li class="flex gap-x-3">✔ <?= _('Lorem ipsum dolor sit amet') ?></li>
                    <li class="flex gap-x-3">✔ <?= _('Consectetur adipiscing elit') ?></li>
                    <li class="flex gap-x-3">✔ <?= _('Integer nec odio. Praesent libero') ?></li>
                    <li class="flex gap-x-3">✔ <?= _('Sed cursus ante dapibus diam') ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>