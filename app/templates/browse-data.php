
<div class=" px-6 py-24 pb-8 sm:pt-32 sm:pb-16 lg:px-8 border-gray-800 border-b">
  <div class="mx-auto max-w-2xl text-center">
    <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl nunito">{<?= $field ?>}</h1>
    <p class="mt-4 text-sm leading-8 text-gray-500">Browse all domains by <?= $field ?></p>
  </div>
</div>






<section class="text-gray-100 my-2 w-full px-4 overflow-hidden">
    <ul class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6">
    <? foreach($items as $item): ?>
    <li class="text-sm text-gray-300 "><a class="hover:text-gray-600" href="domain-list/<?= $item['field'] ?>/<?= $item['value'] ?>"><?= $item['value'] ?></a></li>
    <? endforeach; ?>
    </ul>
</section>




<? //include "techs.php"; ?>
	