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
    <h2 class="mt-6 text-xl font-semibold text-gray-100">Installation Guide</h2>

    <section class="mt-4">
        <h3 class="text-lg font-medium text-gray-100 bg-gray-800 p-4">Initial Setup</h3>
        <ol class="list-decimal pl-8">
            <li>Download the latest version from the repository.</li>
            <li>Extract the files to your preferred directory.</li>
            <li>Ensure your environment meets the required specifications.</li>
        </ol>
    </section>

    <section class="mt-4">
        <h3 class="text-lg font-medium text-gray-100 bg-gray-800 p-4">Configuration</h3>
        <ol class="list-decimal pl-8">
            <li>Modify <code class="bg-gray-700 text-green-300 p-1 rounded">RedirectBase</code> in <span class="bg-gray-700 text-green-300 p-1 rounded">/app/.htaccess</span> and <span class="bg-gray-700 text-green-300 p-1 rounded">/api/.htaccess</span> to match your localhost directory.</li>
            <li>Set your application name, base URL, and other configurations in <span class="bg-gray-700 text-green-300 p-1 rounded">config.php</span>.</li>
            <li>Run <span class="bg-gray-700 text-green-300 p-1 rounded">composer install</span> to install necessary dependencies.</li>
        </ol>
    </section>

    <section class="mt-4">
        <h3 class="text-lg font-medium text-gray-100 bg-gray-800 p-4">Post-Configuration Steps</h3>
        <ol class="list-decimal pl-8">
            <li>Create subdomains and point them to the respective folders: app, api, webhooks, and cdn.</li>
            <li>Import <span class="bg-gray-700 text-green-300 p-1 rounded">database.sql</span> into your MySQL database.</li>
            <li>Update database details and Stripe API keys in <span class="bg-gray-700 text-green-300 p-1 rounded">config.php</span>.</li>
            <li>Set up a webhook from your Stripe dashboard to <span class="bg-gray-700 text-green-300 p-1 rounded">https://yourdomain.com/webhooks/stripe.php</span> to handle Stripe events.</li>
        </ol>
    </section>

    <section class="mt-4">
        <h3 class="text-lg font-medium text-gray-100 bg-gray-800 p-4">Verification and Testing</h3>
        <p>Ensure the setup is correct by accessing the following:</p>
        <ul class="list-disc pl-8">
            <li><a href="/app" class="text-blue-400 hover:text-blue-600">Login Page</a> should open correctly.</li>
            <li><a href="/api" class="text-blue-400 hover:text-blue-600">API Endpoint</a> should display a 'not authenticated' message.</li>
        </ul>
    </section>

    <section class="mt-4">
        <h3 class="text-lg font-medium text-gray-100 bg-gray-800 p-4">Deployment and Usage</h3>
        <p>Modify the automatic deployment settings at <span class="bg-gray-700 text-green-300 p-1 rounded">/webhooks/bitbucket.php</span>.</p>
        <p>Access your main landing or marketing page at the <span class="bg-gray-700 text-green-300 p-1 rounded">/web</span> directory.</p>
        <p>Your custom application should reside in the <span class="bg-gray-700 text-green-300 p-1 rounded">/app</span> folder.</p>
        <p>Your API endpoints will be located within the <span class="bg-gray-700 text-green-300 p-1 rounded">/api</span> folder.</p>
        <p>Models shared between all components are available for use across the application.</p>
    </section>

    <div class="mt-6">
        <a href="web/" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-6 rounded-full">Visit Your SaaS Landing Page</a>
        <a href="app/" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-6 rounded-full">Visit Your SaaS Login Page</a>
    </div>

    <div class="mt-6">
        <a href="https://github.com/natzar/Stripe-Pad/issues" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-6 rounded-full">Get Support!</a>
    </div>
</main>


    <footer>
        <div class="border-t-1 border-t border-indigo-200 mt-10 text-gray-400 pt-3 text-xs mt-10 block">
             <p class="text-xs text-gray-400 mt-5 mb-10 text-center">Licensed under GPL3 | Powered by <strong>Stripepad.com</strong>&copy; Powered by <strong><a href="https://stripepad.com">Stripepad.com</a></strong>. Send feedback <a rel="nofollow" class="underline text-indigo-600" href="mailto:<?= ADMIN_EMAIL ?>" target="_blank">Email</a>
        </div>
    </footer>
</p></div></footer></a></span></span></div>