<!-- 
 * Package Name: Stripe Pad
 * File Description: Index.html file
 * 
 * @author Beto Ayesa <beto.phpninja@gmail.com>
 * @version 1.0.0
 * @package StripePad
 * @license GPL3
 * @link https://github.com/natzar/stripe-pad
 * 
-->
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

    
      <div class="max-w-2xl mx-auto py-8 px-4 sm:py-16 sm:px-6 lg:max-w-7xl lg:px-8">
        <h1 class="text-3xl font-extrabold tracking-tight text-indigo-100 sm:text-5xl lg:text-6xl text-center">Stripe Pad</h1>
        <span class="clear  z-0 flex items-center text-center mx-auto justify-center border-1 border-gray-100 mt-2 space-x-2  mb-5 ">
          <span href="/quote" class="hidden sm:inline-flex relative  items-center  rounded-l-md  text-sm font-medium text-gray-600  focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg> v.0.0.1 </span>
          <span class="-ml-px hidden sm:inline-flex relative inline-flex items-center text-sm font-medium text-gray-600 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
            </svg> Open Source GPL3 &nbsp;<a href="https://github.com/natzar/Stripe-Pad/blob/main/LICENSE.md">
        <img src="https://img.shields.io/github/license/natzar/Stripe-Pad" alt="License: GPL3"></span>
        </span>
        <p class="text-2xl font-light text-gray-200 mb-3 text-center">Thanks for downloading Stripe Pad, a PHP Micro SaaS boilerplate</p>
        
  

        
        
   

    <main class="text-gray-400 leading-6">

        <h2 class="mt-6 text-xl font-semibold sm:text-xl text-gray-100">Get Started </h2>

        <ul>
<li>Download latest version</li>
<li>Follow steps</li>
<li>Continue following steps</li>
        </ul>
        <section>
           <h2 class="bg-white text-gray-900 pl-4">Required Steps</h2>

            <ul class="list">
                <li>Modify RedirectBase in /app/.htaccess. Add your localhost folder /folder/</li>
                <li>Modify RedirectBase in /api/.htaccess. Add your localhost folder /folder/</li>
                <li>Set App Name, base url, ... at config.php</li>
                <li>Run `composer install`</li>
    

            </ul>

            <h2 class="bg-white text-gray-900 pl-4">Recommended Steps</h2>

            <ul class="list">
                <li>Create subdomains and point them to each folder: app, api, webhooks and cdn</li>    
                <li>Import database.sql to your MySql</li>            
                <li>Set database details at config.php</li>    
                <li>Add Stripe api keys at config.php</li>
<li>Add a webhook from https://dashboard.stripe.com/webhooks to https://yourdomain.com/webhooks/stripe.php to manage Stripe events.</li>
            </ul>


            <h2 class="bg-white text-gray-900 pl-4">Test it</h2>
            <a href="/app">/app should open login page</a>
            <a href="/api">/api should show a not authenticated message</a>

            <h2 class="bg-white text-gray-900 pl-4">Automatic deployment from git</h2>
            Modify /webhooks/bitbucket.php

            <h2 class="bg-white text-gray-900 pl-4">Links</h2>
             <strong>Link:</strong> <a href="https://github.com/natzar/stripe-pad">https://github.com/natzar/stripe-pad</a>
            <!-- Metadata Information -->
            
            
                <h2 class="bg-white text-gray-900 pl-4">Start your SaaS</h2>
                <p>Your main landing / marketing page should go under /web folder</p>
                <p>Your custom application will live in /app folder</p>
                <p>Your API will live in/api folder</p>
                <p>Models are shared between al components, you can use them everywhere</p>

       
        </section>

<div class="block mt-5">
          <!-- <a style="width:200px;" class="rounded-full bg-indigo-600 text-white py-3 px-5 mx-auto block my-6 text-center" href="https://www.github.com/natzar/Stripe-Pad">Get it from Github</a> -->
          <a  class="rounded-full bg-indigo-600 text-white py-3 px-5 mx-auto  my-6 text-center" href="web/">Visit your SaaS landing page</a>
<a  class="rounded-full bg-indigo-600 text-white py-3 px-5 mx-auto  my-6 text-center" href="app/">Visit your SaaS login page</a>
          
        </div>
   <a style="width:200px;" class="rounded-full bg-indigo-600 text-white py-3 px-5 mx-auto block my-6 text-center" href="https://github.com/natzar/Stripe-Pad/issues">Get Support!</a>
    </main>

    <footer>
        <div class="border-t-1 border-t border-indigo-200 mt-10 text-gray-400 pt-3 text-xs mt-10 block">
             <p class="text-xs text-gray-400 mt-5 mb-10 text-center">Licensed under GPL3 | Powered by <strong>Stripepad.com</strong>&copy; Powered by <strong><a href="https://stripepad.com">Stripepad.com</a></strong>. Send feedback <a rel="nofollow" class="underline text-indigo-600" href="mailto:<?= ADMIN_EMAIL ?>" target="_blank">Email</a>
        </div>
    </footer>
</p></div></footer></a></span></span></div>