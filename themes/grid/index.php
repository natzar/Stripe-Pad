<!-- 
      Stripe Pad - Micro SaaS boilerplate
      Starter Theme - HTML
      Copyright (C) 2023 Beto Ayesa

      This program is free software: you can redistribute it and/or modify
      it under the terms of the GNU General Public License as published by
      the Free Software Foundation, either version 3 of the License, or
      (at your option) any later version.

      This program is distributed in the hope that it will be useful,
      but WITHOUT ANY WARRANTY; without even the implied warranty of
      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
      GNU General Public License for more details.

      This file is part of Stripe Pad.

      Stripe Pad is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

      Stripe Pad is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

      You should have received a copy of the GNU General Public License along with  Stripe Pad. If not, see <https://www.gnu.org/licenses/>.
-->
<!DOCTYPE html>
<html>
  <head>
    <title>Stripe Pad</title>
      <meta name="title" content="Stripe Pad">
      <meta name="author" content="Php Ninja">
      <meta name="description" content="Stripe Pad, create a public shop from your Stripe products in a minute">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta charset='utf-8'>   
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body>

   


    <div class="bg-white">
  <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
    <span class="bg-indigo-100 rounded-full text-indigo-600 px-4 py-1 text-xs uppercase font-extrabold">Just launched!</span>
   <h2 class="text-6xl font-extrabold tracking-tight text-gray-900 mt-5">Store Front for Stripe</h2>
   <p class="text-2xl font-light text-gray-500 mb-10">Create a public shop with your stripe products, it's free<br>stripepad.com/your-username</p>
   
   
<a class="rounded-full bg-indigo-600 text-white py-3 px-5 inline" href="https://connect.stripe.com/oauth/authorize?response_type=code&client_id=ca_M1NA1F5GhfLiTMO1wbV65OYRJ9COTea8&scope=read_write">Sign in with Stripe</a>

<p class="mt-10 text-gray-500 inline">Sign in to check your store, no commitment. </p>
  

<div class="bg-white">
  <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
    <h2 class="text-2xl font-extrabold">Your Shop</h2>

    <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
      <a href="#" class="group">
        <div class="w-full aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden xl:aspect-w-7 xl:aspect-h-8">
          <img src="https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-01.jpg" alt="Tall slender porcelain bottle with natural clay textured body and cork stopper." class="w-full h-full object-center object-cover group-hover:opacity-75">
        </div>
        <h3 class="mt-4 text-sm text-gray-700">Earthen Bottle</h3>
        <p class="mt-1 text-lg font-medium text-gray-900">$48</p>
      </a>

      <a href="#" class="group">
        <div class="w-full aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden xl:aspect-w-7 xl:aspect-h-8">
          <img src="https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-02.jpg" alt="Olive drab green insulated bottle with flared screw lid and flat top." class="w-full h-full object-center object-cover group-hover:opacity-75">
        </div>
        <h3 class="mt-4 text-sm text-gray-700">Nomad Tumbler</h3>
        <p class="mt-1 text-lg font-medium text-gray-900">$35</p>
      </a>

      <a href="#" class="group">
        <div class="w-full aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden xl:aspect-w-7 xl:aspect-h-8">
          <img src="https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-03.jpg" alt="Person using a pen to cross a task off a productivity paper card." class="w-full h-full object-center object-cover group-hover:opacity-75">
        </div>
        <h3 class="mt-4 text-sm text-gray-700">Focus Paper Refill</h3>
        <p class="mt-1 text-lg font-medium text-gray-900">$89</p>
      </a>

      <a href="#" class="group">
        <div class="w-full aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden xl:aspect-w-7 xl:aspect-h-8">
          <img src="https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-04.jpg" alt="Hand holding black machined steel mechanical pencil with brass tip and top." class="w-full h-full object-center object-cover group-hover:opacity-75">
        </div>
        <h3 class="mt-4 text-sm text-gray-700">Machined Mechanical Pencil</h3>
        <p class="mt-1 text-lg font-medium text-gray-900">$35</p>
      </a>

      <!-- More products... -->
    </div>
  </div>
</div>


  
  
    <div class="border-t-1 border-t border-indigo-200 mt-10 text-gray-400 pt-3 text-xs mt-10 block"><strong>Stripepad.com</strong> is not associated with Stripe. &copy; & Feedback <a  rel="nofollow" class="underline text-indigo-600" href="https://www.twitter.com/betoayesa" target="_blank">Twitter</a></div>
  </div>
  
    </div>
    

<template>
  <h2>Flower</h2>
  <img src="img_white_flower.jpg" width="214" height="204">
</template>

<template id="grid">





  <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8 mt-10">
  
   
      



<? foreach ($products as $p): ?>
<? if (empty($p->images)) $p->images[] = "/product-placeholder.png"; ?>
  
    <div href="#" class="group overflow-hidden mb-10">
        <div class="  bg-gray-100  overflow-hidden ">
          <img height="200" src="<?= $p->images[0] ?>" alt="<?= $p->name ?>" class="rounded-full aspect-w-1 aspect-h-1 object-center object-cover group-hover:opacity-75">
        </div>
        <h3 class="mt-4 text-sm font-semibold text-gray-700"><?= $p->name ?></h3>
        <p class="mt-1 text-xs font-light text-gray-400"><?= $p->description ?></p>
        <p class="mt-1 text-lg font-medium text-gray-900"></p>
        <? foreach($p->price as $p): ?>
        <a href="<?= $p->link->url ?>" class="py-1 rounded-lg px-2 bg-indigo-300 text-white hover:bg-indigo-600">$<?= $p->amount / 100 ?></a>
        
        <? endforeach; ?>
      </div>


<? endforeach; ?>
      <!-- More products... -->
    </div>


</template>

<template id="grid2">

   <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
      


<pre><? print_r($products->data[5]); ?></pre>
<? foreach ($products->autoPagingIterator() as $p): ?>
<? if (!$p->images[0]) $p->images[0] = "https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-01.jpg"; ?>
  
    <div class="group relative ">
        <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none mb-10">
          <img src="<?= $p->images[0] ?>" alt="Front of men&#039;s Basic Tee in black." class="w-full h-full object-center object-cover lg:w-full lg:h-full">
        </div>

        <div class="mt-4 flex justify-between">
          <div>
            <h3 class="text-sm text-gray-700">
              <a href="#">
                <span aria-hidden="true" class="absolute inset-0"></span>
                <?= $p->name ?>
              </a>
            </h3>
            <p class="mt-1 text-sm text-gray-500">   <?= $p->description ?></p>
          </div>
          <? 
          if (!empty($p->default_price)): 
            $price = $stripe->prices->retrieve($p->default_price); 
            ?>
          <p class="text-sm font-medium text-gray-900">$<?= $price->unit_amount / 100 ?>   </p>
          <a href="" class="p-4 bg-indigo-600 text-white">Buy it</a>
        <? endif; ?>
        </div>
      </div>
<? endforeach; ?>
      <!-- More products... -->
    </div>
  </template>
  
    <div class="border-t-1 border-t border-indigo-200 mt-10 text-gray-400 pt-3 text-xs mt-10 block"><?= $shop['title'] ?> @ Powered by <a class="hover:text-indigo-600" href="https://www.stripead.com">Stripepad.com</a> <br> 
</div>
<script>
function showContent() {
  var temp = document.getElementsByTagName("template")[0];
  var clon = temp.content.cloneNode(true);
  document.body.appendChild(clon);
}
</script>
    <script>
var myArr = ["Audi", "BMW", "Ford", "Honda", "Jaguar", "Nissan"];
function showContent() {
  var temp, item, a, i;
  temp = document.getElementsByTagName("template")[0];
  item = temp.content.querySelector("div");
  for (i = 0; i < myArr.length; i++) {
    a = document.importNode(item, true);
    a.textContent += myArr[i];
    document.body.appendChild(a);
  }
}
</script>
  </body>
</html>
