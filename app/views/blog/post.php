<div class=" px-6 py-24 pb-8 sm:pt-16 sm:pb-16 lg:px-8 border-gray-800 border-b">
  <div class="mx-auto max-w-2xl text-center">
    <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl nunito"><?= $title ?></h1>
    <!-- <p class="mt-6 text-lg leading-8 text-gray-300">If you are working with domains you may find these links interesting</p> -->
  </div>
</div>




<div class=" px-6 pt-16 lg:px-8">
  <div class="mx-auto max-w-3xl text-base leading-7 bg-gray-900 p-6 rounded-xl text-gray-400  mb-10">


    <div class="article  max-w-2xl text-base leading-7">

      <?= $body ?>


    </div>
  </div>
</div>

<? $HOOK_JS = "$('.article h2,.article strong,.article h3').addClass('font-bold text-gray-300 mt-4');$('.article h3, .article li').addClass('mt-5');"; ?>