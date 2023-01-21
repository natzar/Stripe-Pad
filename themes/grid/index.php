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
	<title><?= $settings['account']['settings']['dashboard']['display_name'] ?></title>
	  <meta name="title" content="Stripe Pad">	  
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
   <h2 class="text-6xl font-extrabold tracking-tight text-gray-900 mt-5"><?= $settings['account']['settings']['dashboard']['display_name'] ?></h2>
   <p class="text-2xl font-light text-gray-500 mb-10">Edit /themes/<?= Theme ?>/index.php file to change this text</p>
   
   
<a class="rounded-full bg-indigo-600 text-white py-3 px-5 inline" href="javascript:alert('Maybe copy link from a product and use it on this button');">Sign up</a>

<p class="mt-10 text-gray-500 inline">Probably you have more than one product, not sure which one to pick for Sign Up butotn</p>
  

<div class="bg-white">
  <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
	<h2 class="text-2xl font-extrabold">Your Shop</h2>

	<div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
	  
		<? foreach ($settings['products'] as $p): ?>
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

	</div>
  </div>
</div>


  
  
	<div class="border-t-1 border-t border-indigo-200 mt-10 text-gray-400 pt-3 text-xs mt-10 block">
	 &copy; <?= $settings['account']['settings']['dashboard']['display_name'] ?> is powered by	<strong>Stripepad.com</strong>. Send feedback <a  rel="nofollow" class="underline text-indigo-600" href="mailto:<?= AdminEmail ?>" target="_blank">Email</a></div>
  </div>
  
	</div>
	




  </body>
</html>
