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
                    <a href="<?= APP_URL ?>" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"><?= $_SESSION['user']['name'] ?></a>
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
        <img src="<?= APP_LOGO ?>" alt="Foto" class="w-12 h-12 rounded-full" />
        <p class="mt-2 text-pretty text-4xl font-semibold tracking-tight text-gray-950 sm:text-4xl"><?= $SEO_TITLE ?></p>

    </div>
    <p class="text-gray-600 mt-2 text-md block max-w-4xl leading-6"><?= $SEO_DESCRIPTION ?></p>

</div>