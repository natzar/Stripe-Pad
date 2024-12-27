<div class=" px-6 py-24 pb-8 sm:pt-16 sm:pb-16 lg:px-8 border-gray-800 border-b">
  <div class="mx-auto max-w-2xl text-center">
    <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl nunito">Blog</h1>
    <!-- <p class="mt-6 text-lg leading-8 text-gray-300">If you are working with domains you may find these links interesting</p> -->
  </div>
</div>


<div class="max-w-7xl mx-auto text-gray-400  px-4 mt-10 mb-10">
  <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
    <? foreach ($items as $item): ?>
      <article class="flex flex-col items-start justify-between">
        <div class="relative w-full">
          <!-- <img src="https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=3603&q=80" alt="" class="aspect-[16/9] w-full rounded-2xl bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2]">
           -->
          <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
        </div>
        <div class="max-w-xl">

          <div class="group relative">
            <h3 class="mt-3 text-lg font-semibold leading-6 text-indigo-500 group-hover:text-gray-600 nunito">
              <a href="blog/<?= $item['slug'] ?>" class="">
                <span class="absolute inset-0"></span>
                <?= $item['title'] ?> ➽
              </a>
            </h3>
            <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-500"><?= truncate(strip_tags($item['body']), 375) ?></p>
          </div>
          <div class="mt-8 flex items-center gap-x-4 text-xs">
            <time datetime="<?= $item['created'] ?>" class="text-gray-600">Published: <?= $item['created'] ?></time>
            <a href="#" class="relative z-10 rounded-full bg-indigo-700 px-3 py-1 font-medium text-gray-100 hover:bg-gray-100">Marketing</a>
          </div>
          <!--  <div class="relative mt-8 flex items-center gap-x-4">
            <img src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="h-10 w-10 rounded-full bg-gray-100">
            <div class="text-sm leading-6">
              <p class="font-semibold text-gray-900">
                <a href="#">
                  <span class="absolute inset-0"></span>
                  Michael Foster
                </a>
              </p>
              <p class="text-gray-600">Co-Founder / CTO</p>
            </div>
          </div> -->
        </div>
      </article>
    <? endforeach; ?>
    <!-- More posts... -->
  </div>

  </main>

</div>