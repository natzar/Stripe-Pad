<div class="relative px-10">
    <!-- Wrapper for the entire layout -->
    <div class="block flex min-h-screen text-gray-200 ">

        <!-- Sidebar: Navigation -->
        <aside class="sm:w-64  sm:px-8 sm:py-12 sm:fixed overflow-y-auto">
            <h2 class="text-sm uppercase  font-semibold mb-5 text-gray-600">Getting Started</h2>
            <ul class="space-y-2 mb-10">
                <li><a href="documentation#quickstart" class="text-gray-400 hover:text-blue-500">Quickstart</a></li>
                <li><a href="documentation#install" class="text-gray-400 hover:text-blue-500">Installation</a></li>
                <li><a href="documentation#upgrade" class="text-gray-400 hover:text-blue-500">Upgrade Guide</a></li>

            </ul>
            <h2 class="text-sm uppercase  font-semibold mb-5 text-gray-600">Core</h2>
            <ul class="space-y-2 mb-10">
                <li><a href="documentation#components" class="text-gray-400 hover:text-blue-500">Introduction</a></li>
                <li><a href="documentation#routes" class="text-gray-400 hover:text-blue-500">Routes</a></li>
                <li><a href="documentation#models" class="text-gray-400 hover:text-blue-500">Models</a></li>
                <li><a href="documentation#users" class="text-gray-400 hover:text-blue-500">Users</a></li>
                <li><a href="documentation#mail" class="text-gray-400 hover:text-blue-500">Mail</a></li>
                <li><a href="documentation#webhook" class="text-gray-400 hover:text-blue-500">Webhooks</a></li>

                <li><a href="documentation#api" class="text-gray-400 hover:text-blue-500">Api</a></li>

                <li><a href="documentation#cdn" class="text-gray-400 hover:text-blue-500">CDN</a></li>
            </ul>
            <h2 class="text-sm uppercase  font-semibold mb-5 text-gray-600">Customization</h2>
            <ul class="space-y-2 mb-10">
                <li><a href="documentation#app" class="text-gray-400 hover:text-blue-500">Your App</a></li>
                <li><a href="documentation#landing" class="text-gray-400 hover:text-blue-500">Landing page</a></li>
            </ul>
            <h2 class="text-sm uppercase  font-semibold mb-5 text-gray-600">Extras</h2>
            <ul class="space-y-2 mb-10">
                <li><a href="documentation#blog" class="text-gray-400 hover:text-blue-500">Blog</a></li>



            </ul>

        </aside>

        <!-- Main Content -->
        <main class="flex-1 pl-80 pr-32  text-gray-300 text-base pb-16">


            <h2 id="quickstart" class="text-xl text-blue-500 mt-10 uppercase">Quickstart</h2>
            <? include CORE_PATH . "version.php"; ?>

            <p>Stripe Pad Version: <?= $STRIPE_PAD_VERSION ?></p>
            <p>Github Repo: <a href="https://github.com/natzar/Stripe-Pad" target="_blank">https://github.com/natzar/Stripe-Pad</a></p>
            <p>License GPL-3</p><br>

            <p>Stripe Pad is simple PHP SaaS boilerplate designed to streamline the process of building Software as a Service (SaaS). It's simplicity it's the main diferentiator with other boilerplates. This comprehensive guide aims to provide you with all the necessary information to get started with Stripe Pad, from setting up your development environment to deploying your first SaaS application.</p>
            <br>
            <h3>Quick install</h3>
            <blockquote class="bg-gray-900 rounded-md text-white px-6 py-4 border-1 border-gray-700">
                $ git clone https://github.com/natzar/Stripe-Pad.git<br>
                $ composer install<br>
                $ import install/database.sql<br>
                $ edit config.php
            </blockquote><br>
            <h3>Requirements</h3>
            <blockquote class="bg-gray-900 rounded-md text-white px-6 py-4 border-1 border-gray-700">
                Stripe Account (Signup at <a href="https://stripe.com/?ref=stripepad.com" target="_blank">stripe.com</a>)
                <br>
                PHP 7.2<br>
                Composer<br>
                MySQL / MariaDB / SqlLite<br>
                SMTP server<br>

            </blockquote>



            <hr class="border-1 border-gray-500 mt-10">

            <h2 id="install" class="text-xl text-blue-500 mt-10 uppercase">Installation</h2>
            <p>Follow the installation instructions to set up the environment on your local machine. Once you have everything running locally, you are ready to begin the development of your SaaS application.</p>

            <h3>Download Stripe Pad From Github</h3>

            <blockquote class="bg-gray-900 rounded-md text-white px-6 py-4 border-1 border-gray-700">
                Download the latest version from the repository an uncompress it
            </blockquote>
            <h3>Git clone</h3>
            <blockquote class="bg-gray-900 rounded-md text-white px-6 py-4 border-1 border-gray-700">
                git clone https://github.com/natzar/Stripe-Pad.git<br>

            </blockquote>
            <p> Then, open https://www.yourdomain.com/stripe-pad/install/. The installer will fill up config.php for you and import install/database.sql, in case something failed, please try manual installation.</p>

            <h3>Manual installation </h3>
            <blockquote class="bg-gray-900 rounded-md text-white px-6 py-4 border-1 border-gray-700">
            </blockquote>
            <ul>
                <li>Run <span class="bg-gray-700 text-red-300 p-1 rounded">composer install</span> to install necessary dependencies.</li>

                <li>Import <span class="bg-gray-700 text-red-300 p-1 rounded">database.sql</span> into your MySQL database.</li>

            </ul>
            <h3>Environment</h3>
            <ol class="list-decimal pl-8 space-y-2">
                <li>Set your application name, base URL, Stripe API Keys, Database settings and all configurations in <span class="bg-gray-700 text-red-300 p-1 rounded">config.php</span>.</li>

                <li>Optional: Check .htaccess if you will be running in a /subfolder/ <code class="bg-gray-700 text-red-300 p-1 rounded">RedirectBase</code> in <span class="bg-gray-700 text-red-300 p-1 rounded">/app/.htaccess</span> and <span class="bg-gray-700 text-red-300 p-1 rounded">/api/.htaccess</span> to match your localhost directory.</li>
                <li>Optional: Create subdomains and point them to the respective folders: app, api, webhooks, and cdn.</li>



            </ol>



            <h3>Finishing</h3>

            <ol class="list-decimal pl-8 space-y-2">
                <li>Set up a webhook from your Stripe dashboard to <span class="bg-gray-700 text-red-300 p-1 rounded">https://yourdomain.com/webhooks/stripe.php</span> to handle Stripe events.</li>

                <li>Set up automatic deployment from a git repository<span class="bg-gray-700 text-red-300 p-1 rounded">/webhooks/deploy.php</span>.</li>

                <li>
                </li>

            </ol>
            </section>

            <blockquote class="bg-gray-900 rounded-md text-white px-6 py-4 border-1 border-gray-700">

                npm install -D tailwindcss
                npx tailwindcss init
                app/css/build/compile-tailwind.sh
            </blockquote>
            <h3 class="text-lg font-medium text-gray-100 bg-gray-800 p-4  rounded-full pl-8">Verification and Testing</h3>
            <p>Ensure the setup is correct by accessing the following:</p>


            <ul class="list-disc pl-8">
                <li><a href="/app" class="text-blue-400 hover:text-blue-600">Login Page</a> should open correctly.</li>
                <li><a href="/api" class="text-blue-400 hover:text-blue-600">API Endpoint</a> should display a 'not authenticated' message.</li>
                <li>Access your main landing or marketing page at the <span class="bg-gray-700 text-red-300 p-1 rounded">/web</span> directory.</li>
                <li>Your custom application should reside in the <span class="bg-gray-700 text-red-300 p-1 rounded">/app</span> folder.</li>
                <li>Your API endpoints will be located within the <span class="bg-gray-700 text-red-300 p-1 rounded">/api</span> folder.</li>
                <li>Models shared between all components are available for use across the application.</li>
            </ul>

            <div class="mt-6">
                <!-- <a href="web/" class="inline-block bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-6 rounded-full">Visit Your SaaS Landing Page</a>
        <a href="app/" class="inline-block bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-6 rounded-full">Visit Your SaaS Login Page</a>
         --><a href="https://github.com/natzar/Stripe-Pad/issues" class="inline-block bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-6 rounded-full">Get Support!</a>
            </div>
            <hr class="border-1 border-gray-500 mt-10">
            <h2 id="upgrade" class="text-xl text-blue-500 mt-10 uppercase">Upgrade Guide</h2>

            <p>To upgrade Stripe Pad you just need to replace core files</p>
            1- Replace core folder with the new version<br>
            2- Replace load.php with the new version<br>
            <hr class="border-1 border-gray-500 mt-10">



            <h2 id="components" class="text-xl text-blue-500 mt-10 uppercase">Components</h2>
            <p>The base of Stripe Pad is structured as a simplistic MVC (Model-View-Controller (1)) PHP application. </p>
            <p><img width="500" class="mx-auto" src="https://www.stripepad.com/relations.png" alt="Stripe Pad Relations"></p>

            <ul>
                <li>Find and add your models at app/models</li>
                <li>Find and add your views (templates) at app/views/</li>
                <li>Everything else where users makes requests to (api, webhooks, web (index.php), widget, cronjobs) could be considered the controllers.</li>
            </ul>

            <h2>Paths</h2>
            <h3>Any visit to /faq (example)</h3>
            <ol>
                <li>htaccess: will translate /faq for index.php?p=faq</li>
                <li>index.php: will execute App->faq(), faq is a method inside app/App.php</li>
                <li>App->faq will load details via faqsModel and pass it to the view</li>
                <li>the view will include and render the template inside /app/views using the $data provided</li>
                <li>The user will see the Faq page</li>

            </ol>

            <h3>Signup A: /signupp redirects to stripe checkout page</h3>
            <ol>
                <li>htaccess: will translate /faq for index.php?p=faq</li>
                <li>index.php: will execute App->faq(), faq is a method inside app/App.php</li>
                <li>App->faq will load details via faqsModel and pass it to the view</li>
                <li>the view will include and render the template inside /app/views using the $data provided</li>
                <li>The user will see the Faq page</li>

            </ol>

            <h3>Signup B: Signup without payment</h3>
            <ol>
                <li>htaccess: will translate /signup for index.php?p=faq</li>
                <li>index.php: will execute App->signup(), signup is a method inside app/App.php or core/StripePad.php (App extends StripePad and you can overwrite any method).</li>
                <li>App->signup will load details (empty) and pass it to the view</li>
                <li>The user will fill the form and submit to /actionSignup (actionSignup method defined in core/Stripepad.php)</li>
                <li>An email with passwords will be sent</li>
                <li>The user can now log in and find stripe links inside the private area</li>


            </ol>


            <h2>Folders and files</h2>
            <p>Ideally you will have set each folder on different domains or subdomains.<br>
                api.domain.com for your api, webhooks.domain.com, domain.com for /, </p>
            <h3>folders</h3>
            <ul>
                <li><strong>api</strong>: Serves as the foundation for all model classes, incorporating database connection functionality.</li>
                <li><strong>app</strong>: Manages template rendering and data handling.</li>
                <li><strong>cdn</strong>: Facilitates MySQL database connections.</li>
                <li><strong>core</strong>: Facilitates MySQL database connections.</li>
                <li><strong>crons</strong>: Facilitates MySQL database connections.</li>
                <li><strong>docs</strong>: Facilitates MySQL database connections.</li>
                <li><strong>install</strong>: Facilitates MySQL database connections.</li>
                <li><strong>mails</strong>: Facilitates MySQL database connections.</li>
                <li><strong>pdfs</strong>: Facilitates MySQL database connections.</li>
                <li><strong>tests</strong>: Facilitates MySQL database connections.</li>
                <li><strong>webhooks</strong>: Facilitates MySQL database connections.</li>
            </ul>
            <h3>files</h3>
            <ul>
                <li>.htaccess</li>
                <li>config.php</li>
                <lii>index.php</lii>
                <li>load.php</li>
                <li>stripe-pad-errors.log</li>
            </ul>

            <h2>Modules</h2>
            <ul>
                <li>EmailValidator</li>
                <li>Request Bot Blocker</li>
            </ul>
            <p>Key environmental files include:</p>
            <ul>
                <li><strong>.htaccess</strong>: Redirects URLs in the format <code>/a/b/c/d</code> to <code>index.php?p=a&amp;m=b&amp;i=c</code> (without physically redirecting). Additional parameters can be added for deeper navigation.</li>
                <li><strong>config.php</strong>: Centralizes all settings, API keys, and secrets. It is exclusively included by <code>load.php</code>.</li>
                <li><strong>load.php</strong>: Initializes the application by loading <code>config.php</code>, managing error handling, including all model files, and integrating composer packages.</li>
            </ul>
            <p>For optimal security and organization, setting up dedicated domains or subdomains for different application aspects (such as cron jobs, core functionality, and CDN) is advised.</p>
            <hr class="border-1 border-gray-500 mt-10">

            <h2 id="routes" class="text-xl text-blue-500 mt-10 uppercase">Routes</h2>
            <h2>Adding New URLs</h2>
            <p>To introduce new URLs to your application, open /app/App.php and add a new method:</p>
            <blockquote class="bg-gray-900 rounded-md text-white px-6 py-4 border-1 border-gray-700">
                public function newpage(){
                $this->view('template.php',$data); // Load the template with $data in the view
                }
            </blockquote>
            <ol>
                <li>Edit <code>app/themes/[your-theme]/app.php</code>.</li>
                <li>Add new methods corresponding to your desired URLs, for example, <code>public function faq() {}</code> which will make <code>https://your-domain.com/faq</code> accessible.</li>
            </ol>
            <hr class="border-1 border-gray-500 mt-10">
            <h2 id="models" class="text-xl text-blue-500 mt-10 uppercase">Models</h2>
            <p>Instead of embedding SQL directly within your controllers or views, utilize models:</p>

            <p>Models serve as adapters for your MySQL queries. Create a new model by duplicating an existing one and adding new methods as needed.</p>
            <p>For example, create a method within your model:</p>
            <blockquote class="bg-gray-900 rounded-md text-white px-6 py-4 border-1 border-gray-700">
                public function getByLastLogin($id) { // add new method<br>
                $query = $this->db->prepare("Your SQL query logic here with :params limit 1");<br>
                $query->bindParam(":params", $params); // example<br>
                $query->execute();<br>
                return $query->fetch();<br>
                }</blockquote>

            <p>Now you can use it inside App.php (All files in app/models are automatically included).</p>

            <p>Inside any method of app/App.php, use the model to fetch data:</p>
            <blockquote class="bg-gray-900 rounded-md text-white px-6 py-4 border-1 border-gray-700">
                public function dashboard() { // using /dashboard endpoint
                $users = new usersModel();
                echo $users-&gt;getByLastLogin(4);
                }
            </blockquote>

            <p>This approach keeps your application organized and maintains a separation of concerns between your database logic and your application logic.</p>

            <hr class="border-1 border-gray-500 mt-10">
            <h2 id="users" class="text-xl text-blue-500 mt-10 uppercase">Users</h2>
            <p>Users are identified by email</p>
            <ul>
                <li>name: String</li>
                <li>email: String</li>
                <li>password: String</li>
                <li>stripe_customer_id: String</li>
                <li>group: String, default: customers</li>
            </ul>
            <blockquote class="bg-gray-900 rounded-md text-white px-6 py-4 border-1 border-gray-700">
                $users = new usersModel();<br>
                $user = $users->find('beto@gmail.com');
            </blockquote>
            <hr class="border-1 border-gray-500 mt-10">
            <h2 id="emails" class="text-xl text-blue-500 mt-10 uppercase">Transactional Emails</h2>

            <p>An email system comes enabled by default using SMTP server. To-do: integrate other services like Mailgun.</p>
            <p>You must update settings at config.php</p>

            <h3>Templates</h3>
            <p>Email templates are in /mails folder.</p>
            <ul>
                <li>Welcome</li>
                <li>Password Reset</li>
                <li>Payment received</li>
            </ul>

            <h3>How to send Email or template?</h3>
            <blockquote class="bg-gray-900 rounded-md text-white px-6 py-4 border-1 border-gray-700">
                $mails = new mailsModel();<br>
                $mails->sendTemplate('welcome', $subject, $to, $data );
            </blockquote>
            <hr class="border-1 border-gray-500 mt-10">
            <h2 id="webhooks" class="text-xl text-blue-500 mt-10 uppercase">Webhooks</h2>
            <p>Facilitate automated interactions with external systems:</p>
            <ul>
                <li><strong>deploy.php</strong>: Configurable for automatic deployment via Bitbucket or Git hooks.</li>
                <li><strong>stripe.php</strong>: Endpoint for receiving events from Stripe.</li>
            </ul>
            <hr class="border-1 border-gray-500 mt-10">
            <h2 id="cronjobs" class="text-xl text-blue-500 mt-10 uppercase">Cronjobs</h2>
            <p>This section is designated for scheduling and managing cronjobs. Scripts within the 'crons' directory should start by including <code>load.php</code>, initializing required models, and executing necessary tasks. These scripts can then be scheduled directly on the server.</p>
            <hr class="border-1 border-gray-500 mt-10">
            <h2 id="api" class="text-xl text-blue-500 mt-10 uppercase">Api</h2>
            <p>API comes in 2 forms, v1 and v2.</p>
            <ul>
                <li>v1: just 1 endpoint user for 1 action (search, get info, whatever...)</li>
                <li>v2: Very Simple API REST. You can instance here your models and return JSON responses</li>
            </ul>

            <p> v3 is coming, Guzzle + REST</p>

            <hr class="border-1 border-gray-500 mt-10">





            <h2 id="cdn" class="text-xl text-blue-500 mt-10 uppercase">CDN</h2>
            <h2>CDN</h2>
            <p>The 'cdn' directory is intended for static assets such as JavaScript, CSS, and images. Ideally, these should be served from a separate domain or subdomain to improve loading times and security.</p>
            <hr class="border-1 border-gray-500 mt-10">




            <h2 id="app" class="text-xl text-blue-500 mt-10 uppercase">Your app</h2>
            <p>index.php is the boilerplate, app/app.php it's an extended StripePad Class. You can override the parent methods.
                All your application logic will be in app/app.php, public &amp; private sides, is all there, all urls are defined there. </p>

            <p>To enhance your dashboard functionality:</p>
            <ol>
                <li>In <code>app/app.php</code>, modify the <code>dashboard</code> method to include any necessary database data.</li>
                <li>Instantiate your model, call its methods, retrieve the data, and pass this data to the view.</li>
            </ol>
            <h2>Incorporating JavaScript Frameworks</h2>
            <p>If your application requires a JavaScript framework:</p>
            <ol>
                <li>Include the necessary <code>&lt;script&gt;</code> tags within the relevant PHP templates, particularly within <code>dashboard.php</code>.</li>
            </ol>
            <p>To create a new theme:</p>
            <ol>
                <li>Duplicate the <code>app/themes/basic-dark</code> directory. Rename the new directory to reflect the primary keyword of your niche, optimizing for SEO purposes.</li>
                <li>Your main file for customization will be <code>app/themes/[your-new-theme]/dashboard.php</code>.</li>
                <li>Update the configuration file <code>config.php</code> within your theme folder, setting <code>APP_THEME</code> to the name of your new folder.</li>
            </ol>
            <h2 id="landing" class="text-xl text-blue-500 mt-10 uppercase">Landing Page</h2>
            <p>The 'landing' directory hosts all public-facing parts of your SaaS, including marketing content and user acquisition elements. To extend the landing page:</p>
            <ol>
                <li>Create new HTML/PHP templates within <code>templates/landing/</code>.</li>
                <li>Add corresponding methods to <code>app/app.php</code> for new pages, e.g., <code>public function about()</code>.</li>
                <li>Implement the desired logic and view rendering within these new methods.</li>
            </ol>
            <p>This setup enables straightforward routing from URLs to respective application methods and views.</p>
            <h3>Your code goes here</h3>
            <p>Access to the core application features, such as the dashboard, is restricted to authenticated users. The dashboard acts as the entry point for logged-in users, hosting the primary functionality and data interactions of your SaaS solution. Start by modifying <code>dashboard.php</code> to tailor it to your application's needs.</p>




            <h2 id="widget">Widget</h2>
            <p>In case you want to build a widget that users will insert in their websites, you can use this. </p>





        </main>

        <!-- Right Sidebar: On-page navigation -->
        <nav class="w-48  py-12  inset-y-0 right-0 overflow-y-auto">

        </nav>
    </div>
</div>