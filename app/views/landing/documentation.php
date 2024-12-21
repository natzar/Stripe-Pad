<div class="relative px-10">
    <!-- Wrapper for the entire layout -->
    <div class="block flex min-h-screen ">

        <!-- Sidebar: Navigation -->
        <aside class="w-64 bg-gray-800 px-8 py-12  overflow-y-auto">
            <h2 class="text-xl text-white font-semibold mb-10">Docs</h2>
            <ul class="space-y-2">
                <li><a href="#introduction" class="text-gray-400 hover:text-blue-500">Introduction</a></li>
                <li><a href="#installation" class="text-gray-400 hover:text-blue-500">Installation</a></li>
                <li><a href="#configuration" class="text-gray-400 hover:text-blue-500">Configuration</a></li>
                <li><a href="#customizing" class="text-gray-400 hover:text-blue-500">Customizing</a></li>
                <li><a href="#advanced-topics" class="text-gray-400 hover:text-blue-500">Advanced Topics</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 pl-64 pr-32 py-12 text-white text-base">
            <div id="introduction" class="mb-12">
                <h1 class="text-3xl font-bold mb-4">Introduction</h1>
                <p>Explanation of what Stripe Pad is and how it can be used in various scenarios.</p>
                ## Structure

                Space to insert your code:
                - **crons**: Scripts and cronjobs.
                - **app**: Custom application code & landing page. All HTML is here.
                - **cdn**: Subdomain for static assets.

                These are core files, they will break with an update:
                - **core**: Core files for database connections and templates.
                - **webhooks**: Handlers for webhooks (default: Stripe and Bitbucket).
                - **API**: Basic API functionality.

                ![Relations between components](https://www.stripepad.com/relations.png)

                ## Features

                - Public: Landing page
                - Private: User Profile, Your App
                - MVC. Controllers, Models shared between all controllers, and JSON + templates for the views part.
                - Webhooks management for Stripe events.
                - Divided in subdomains or subfolders
                - PHP is the only requirement, how you build you app inside /app folder is up to you
                - Easy to modify and customize




                ### Tech Stack

                Packed with basic stuff only.

                1. Php. MVC style, no framework.
                2. Vanilla Js & jQuery, just to open/close mobile menu
                3. Composer, to install stripe and email dependencies

                Basic theme uses Tailwind. 100% optional. You can edit /app folder completely.


            </div>
            <div id="installation" class="mb-12">
                <h2 class="text-2xl font-bold mb-4">Installation</h2>
                <p>To get started with Stripe Pad, follow these steps to ensure a proper setup:</p>
                <ol class="list-decimal pl-4">
                    <li>Ensure your system meets all required dependencies: PHP 7.4+, Composer, and MySQL.</li>
                    <li>Clone the repository from GitHub:</li>
                    <pre class="bg-gray-700 text-white p-2 rounded"><code>git clone https://github.com/yourusername/stripe-pad.git</code></pre>
                    <li>Install all Composer dependencies:</li>
                    <pre class="bg-gray-700 text-white p-2 rounded"><code>composer install</code></pre>
                    <li>Copy the sample configuration file and modify it according to your environment:</li>
                    <pre class="bg-gray-700 text-white p-2 rounded"><code>cp .env.example .env</code></pre>
                    <li>Generate your application key:</li>
                    <pre class="bg-gray-700 text-white p-2 rounded"><code>php artisan key:generate</code></pre>
                    <li>Run the database migrations and seed the database:</li>
                    <pre class="bg-gray-700 text-white p-2 rounded"><code>php artisan migrate --seed</code></pre>
                    <li>You are now ready to start your Stripe Pad application.</li>
                </ol>
            </div>

            <div id="configuration" class="mb-12">
                <h2 class="text-2xl font-bold mb-4">Configuration</h2>
                <p>Configuring Stripe Pad is essential to tailor the software to your specific needs. Follow the steps below to configure your installation properly:</p>
                <ol class="list-decimal pl-4">
                    <li>Set environment variables in the <code>.env</code> file. This includes database settings, API keys, and other operational parameters that Stripe Pad relies on.</li>
                    <li>Adjust the application settings in the admin panel:</li>
                    <ul class="list-disc pl-8">
                        <li>API configurations</li>
                        <li>User management settings</li>
                        <li>Payment and billing options</li>
                    </ul>
                    <li>For advanced users, delve into the <code>config/app.php</code> file to set up:</li>
                    <ul class="list-disc pl-8">
                        <li>Locale and timezone settings</li>
                        <li>Service providers</li>
                        <li>Class aliases for ease of development</li>
                    </ul>
                </ol>
            </div>

            <div id="customizing" class="mb-12">
                <h2 class="text-2xl font-bold mb-4">Customizing</h2>
                <p>Stripe Pad allows for extensive customization to meet the unique demands of your project. Here are some ways you can customize your setup:</p>
                <ol class="list-decimal pl-4">
                    <li>Themes: Change the visual appearance by modifying or creating new themes.</li>
                    <li>Modules: Enhance functionality by developing new modules or modifying existing ones.</li>
                    <li>Integrations: Integrate with third-party services for enhanced capabilities.</li>
                </ol>
                <p>For more detailed instructions on customizing each aspect, refer to the developer guides provided in the subsequent sections.</p>
            </div>

            <div id="advanced-topics" class="mb-12">
                <h2 class="text-2xl font-bold mb-4">Advanced Topics</h2>
                <p>For those looking to get the most out of Stripe Pad, exploring advanced topics is crucial. This section covers:</p>
                <ul class="list-disc pl-4">
                    <li>Performance optimization techniques</li>
                    <li>Security best practices</li>
                    <li>Automated testing and continuous integration setups</li>
                    <li>Detailed API documentation</li>
                </ul>
                <p>Each topic is covered in depth to provide you with the knowledge needed to optimize your use of Stripe Pad.</p>
            </div>

        </main>

        <!-- Right Sidebar: On-page navigation -->
        <nav class="w-48 bg-gray-800 py-12  inset-y-0 right-0 overflow-y-auto">
            <h3 class="px-4 text-lg text-white font-semibold mb-6">On this page</h3>
            <ul class="space-y-2 px-4">
                <li><a href="#introduction" class="text-gray-400 hover:text-blue-500 block">Introduction</a></li>
                <li><a href="#installation" class="text-gray-400 hover:text-blue-500 block">Installation</a></li>
                <li><a href="#configuration" class="text-gray-400 hover:text-blue-500 block">Configuration</a></li>
                <li><a href="#customizing" class="text-gray-400 hover:text-blue-500 block">Customizing</a></li>
                <li><a href="#advanced-topics" class="text-gray-400 hover:text-blue-500 block">Advanced Topics</a></li>
            </ul>
        </nav>
    </div>
</div>