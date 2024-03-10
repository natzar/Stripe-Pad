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
        <h1 class="text-3xl font-extrabold tracking-tight text-gray-100 sm:text-5xl lg:text-6xl text-center">Download Stripe Pad</h1>
        <span class="clear  z-0 flex items-center text-center mx-auto justify-center border-1 border-gray-100 mt-2 space-x-2  mb-5 ">
          <span href="/quote" class="hidden sm:inline-flex relative  items-center  rounded-l-md  text-sm font-medium text-gray-600  focus:z-10 focus:outline-none focus:ring-1 focus:ring-green-500 focus:border-green-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg> v.0.0.1 </span>
          <span class="-ml-px hidden sm:inline-flex relative inline-flex items-center text-sm font-medium text-gray-600 focus:z-10 focus:outline-none focus:ring-1 focus:ring-green-500 focus:border-green-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
            </svg> Open Source GPL3 &nbsp;<a href="https://github.com/natzar/Stripe-Pad/blob/main/LICENSE.md">
        <img src="https://img.shields.io/github/license/natzar/Stripe-Pad" alt="License: GPL3"></span>
        </span>
        <p class="text-2xl font-light text-gray-200 mb-3 text-center"></p>
        
  

        <main class="text-gray-400 leading-6 space-y-6">
    <h2 class="mt-6 text-xl font-semibold text-gray-100">Installation Guide</h2>

    <section class="mt-4">
        <h3 class="text-lg font-medium text-gray-100 bg-gray-800 p-4 mb-4 rounded-full pl-8">Initial Setup</h3>
        <ol class="list-decimal pl-8 space-y-2">
            <li>Download the latest version from the repository. https://github.com/natzar/Stripe-Pad/releases/tag/v.0.0.1-alpha</li>
            <li>Extract the files to your preferred directory (htdocs)</li>
            
        </ol>
    </section>

    <section class="mt-4">
        <h3 class="text-lg font-medium text-gray-100 bg-gray-800 p-4 mb-4  rounded-full pl-8">Configuration</h3>
        <ol class="list-decimal pl-8 space-y-2">
             <li>Set your application name, base URL, Stripe API Keys, Database settings and all configurations in <span class="bg-gray-700 text-green-300 p-1 rounded">config.php</span>.</li>

            <li>Optional: Check .htaccess if you will be running in a /subfolder/ <code class="bg-gray-700 text-green-300 p-1 rounded">RedirectBase</code> in <span class="bg-gray-700 text-green-300 p-1 rounded">/app/.htaccess</span> and <span class="bg-gray-700 text-green-300 p-1 rounded">/api/.htaccess</span> to match your localhost directory.</li>
            <li>Optional: Create subdomains and point them to the respective folders: app, api, webhooks, and cdn.</li>

           
            
        </ol>
    </section>

    <section class="mt-4">
        <h3 class="text-lg font-medium text-gray-100 bg-gray-800 p-4 mb-4  rounded-full pl-8">Post-Configuration Steps</h3>
        <ol class="list-decimal pl-8 space-y-2">
            <li>Run <span class="bg-gray-700 text-green-300 p-1 rounded">composer install</span> to install necessary dependencies.</li>
            
            <li>Import <span class="bg-gray-700 text-green-300 p-1 rounded">database.sql</span> into your MySQL database.</li>
            
            <li>Set up a webhook from your Stripe dashboard to <span class="bg-gray-700 text-green-300 p-1 rounded">https://yourdomain.com/webhooks/stripe.php</span> to handle Stripe events.</li>
            
            <li>Set up automatic deployment from a git repository<span class="bg-gray-700 text-green-300 p-1 rounded">/webhooks/deploy.php</span>.</p>

        </ol>
    </section>



    <section class="mt-4">
        <h3 class="text-lg font-medium text-gray-100 bg-gray-800 p-4  rounded-full pl-8">Verification and Testing</h3>
        <p>Ensure the setup is correct by accessing the following:</p>
        <ul class="list-disc pl-8">
            <li><a href="/app" class="text-blue-400 hover:text-blue-600">Login Page</a> should open correctly.</li>
            <li><a href="/api" class="text-blue-400 hover:text-blue-600">API Endpoint</a> should display a 'not authenticated' message.</li>
             <li>Access your main landing or marketing page at the <span class="bg-gray-700 text-green-300 p-1 rounded">/web</span> directory.</li>
        <li>Your custom application should reside in the <span class="bg-gray-700 text-green-300 p-1 rounded">/app</span> folder.</li>
        <li>Your API endpoints will be located within the <span class="bg-gray-700 text-green-300 p-1 rounded">/api</span> folder.</li>
        <li>Models shared between all components are available for use across the application.</li>
        </ul>
    </section>
    <div class="mt-6">
        <a href="web/" class="inline-block bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-6 rounded-full">Visit Your SaaS Landing Page</a>
        <a href="app/" class="inline-block bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-6 rounded-full">Visit Your SaaS Login Page</a>
        <a href="https://github.com/natzar/Stripe-Pad/issues" class="inline-block bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-6 rounded-full">Get Support!</a>
    </div>

</main>



</p></div></footer></a></span></span></div>