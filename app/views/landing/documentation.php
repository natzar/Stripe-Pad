<div class="relative px-3 sm:px-10">
    <!-- Wrapper for the entire layout -->
    <div class="block flex min-h-screen text-gray-200 ">

        <!-- Sidebar: Navigation -->
        <aside class="hidden sm:block sm:w-64  sm:px-8 sm:py-12 sm:fixed overflow-y-auto">
            <h2 class="text-sm uppercase  font-semibold mb-5 text-gray-600">Getting Started</h2>
            <ul class="space-y-2 mb-10">
                <li><a href="documentation#quickstart" class="text-gray-400 hover:text-blue-500">Quickstart</a></li>
                <li><a href="documentation#install" class="text-gray-400 hover:text-blue-500">Installation</a></li>
                <li><a href="documentation#upgrade" class="text-gray-400 hover:text-blue-500">Upgrade Guide</a></li>

            </ul>
            <h2 class="text-sm uppercase  font-semibold mb-5 text-gray-600">Customization</h2>
            <ul class="space-y-2 mb-10">
                <li><a href="documentation#introduction" class="text-gray-400 hover:text-blue-500">Introduction</a></li>
                <li><a href="documentation#app" class="text-gray-400 hover:text-blue-500">Your App</a></li>
                <li><a href="documentation#landing" class="text-gray-400 hover:text-blue-500">Landing page</a></li>
                <li><a href="documentation#extend" class="text-gray-400 hover:text-blue-500">Extending it</a></li>
            </ul>
            <h2 class="text-sm uppercase  font-semibold mb-5 text-gray-600">Core Components</h2>
            <ul class="space-y-2 mb-10">

                <li><a href="documentation#routes" class="text-gray-400 hover:text-blue-500">Routes</a></li>
                <li><a href="documentation#models" class="text-gray-400 hover:text-blue-500">Models</a></li>
                <li><a href="documentation#users" class="text-gray-400 hover:text-blue-500">Users</a></li>
                <li><a href="documentation#mail" class="text-gray-400 hover:text-blue-500">Mail</a></li>
                <li><a href="documentation#webhook" class="text-gray-400 hover:text-blue-500">Webhooks</a></li>




            </ul>

            <h2 class="text-sm uppercase  font-semibold mb-5 text-gray-600">Extras</h2>
            <ul class="space-y-2 mb-10">
                <li><a href="documentation#api" class="text-gray-400 hover:text-blue-500">Api</a></li>
                <li><a href="documentation#blog" class="text-gray-400 hover:text-blue-500">Blog</a></li>
                <li><a href="documentation#cdn" class="text-gray-400 hover:text-blue-500">CDN</a></li>


            </ul>

        </aside>

        <!-- Main Content -->
        <main class="md:flex-1 md:pl-80 md:pr-32  text-gray-300 text-base pb-16">



            <h2 id="quickstart" class="text-xl text-blue-500 mt-10 uppercase mb-5">1. Quickstart</h2>
            <? include CORE_PATH . "sp-version.php"; ?>

            <p>Stripe Pad Version: <?= $STRIPE_PAD_VERSION ?></p>
            <p>Github Repo: <a href="https://github.com/natzar/Stripe-Pad" target="_blank">https://github.com/natzar/Stripe-Pad</a></p>
            <p>Free Software · License GPL-3</p><br>

            <p>Stripe Pad is simple PHP SaaS boilerplate designed to streamline the process of building Software as a Service (SaaS). It's simplicity it's the main diferentiator with other boilerplates. This comprehensive guide aims to provide you with all the necessary information to get started with Stripe Pad, from setting up your development environment to deploying your first SaaS application.</p>
            <br>


            <h3 class="mt-4 mb-4 font-bold text-lg text-blue-500">Download Latest Version</h3>

            <blockquote class="cursor-pointer bg-gray-900 rounded-xl text-white p-3 border-1 border-gray-700 hover:bg-black">
                <a href="https://github.com/natzar/Stripe-Pad/releases/download/v1/StripePad-v1.0.0.zip" target="_blank" class="block p-4 bg-gray-800 rounded-xl ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12 inline">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9.75v6.75m0 0-3-3m3 3 3-3m-8.25 6a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                    </svg>Download Stripe Pad v1.0.0-alpha <small class="text-xs">(ZIP File)</small><br>

                </a>
            </blockquote>
            <p class="mb-5">After download completes, uncompress the zip file to your root's folder path, and navigate to yourdomain.com to start installation process &rarr; </p>
            <h3 class="mt-4 mb-4 font-bold text-lg text-blue-500">Requirements</h3>
            <blockquote class="bg-gray-900 rounded-md text-white px-6 py-4 border-1 border-gray-700">
                Stripe Account (Signup at <a href="https://stripe.com/?ref=stripepad.com" target="_blank">stripe.com</a>)
                <br>
                PHP 7.2<br>

                MySQL / MariaDB / SqlLite<br>
                SMTP server<br>

            </blockquote>



            <hr class="border-1 border-gray-800 mt-10">

            <h2 id="install" class="text-xl text-blue-500 mt-10 uppercase mb-5">2. Installation</h2>
            <p>Follow the installation instructions to set up the environment.</p>




            <h3 class="mt-4 mb-4 font-bold text-lg text-blue-500">2.1 Get the Code</h3>
            <p>You can download a zip with the latest release or you can clone the repo with the latest version</p>
            <h4 class="mt-2 mb-2 font-bold text-blue-400 text-base">&rarr;&nbsp;2.1.1 Download the latest version from the repository an uncompress it</h4>
            <p class="mb-5"><a href="https://github.com/natzar/Stripe-Pad/releases/download/v1/StripePad-v1.0.0.zip" target="_blank">Download latest version</a></p>

            <h4 class="mt-2 mb-2 font-bold text-blue-400 text-base">&rarr;&nbsp;2.1.2 [DEVELOPERS] Git clone </h4>
            <blockquote class="bg-gray-900 rounded-md text-white px-6 py-4 border-1 border-gray-700">
                $ git clone https://github.com/natzar/Stripe-Pad.git<br>

            </blockquote>

            <h3 class="mt-4 mb-4 font-bold text-lg text-blue-500">2.2 Configuration & Settings</h3>
            <blockquote class="bg-gray-900 rounded-md text-white px-6 py-4 border-1 border-gray-700">
                <h3 class="mt-4 mb-4 font-bold text-lg text-blue-500">Important note: running it in a sub-folder?</h3>
                <p class="text-xs">If you will be running stripe pad from a sub folder, like yourdomain.com/your-folder/ you need to edit .htaccess, look for RewriteBase in the .htaccess file (Slash at first and last position):</p><br>
                RewriteBase /your-folder/
            </blockquote>

            <h4 class="mt-2 mb-2 font-bold text-blue-400 text-base">&rarr;&nbsp;2.2.1 Automatic Configuration</h4>
            <p>Open yourdomain.com or localhost relative to your stripe pad folder in your browser and installation process will start.</p>

            <blockquote class="bg-gray-900 rounded-md text-white px-6 py-4 border-1 border-gray-700">
                open https://www.yourdomain.com/install/ in your browser.</blockquote>
            <p> <br>The installer will fill up config.php for you and import install/database.sql, in case something failed, please try manual installation.</p>

            <h4 class="mt-2 mb-2 font-bold text-blue-400 text-base">&rarr;&nbsp;2.2.2 Manual Configuration </h4>
            <blockquote class="bg-gray-900 rounded-md text-md text-white px-6 py-4 border-1 border-gray-700">
                1. Duplicate sp-config.sample.php and rename it to sp-config.php<br>
                2. Edit sp-config.php with your favorite text editor and define all settings
                3. composer install<br>
                4. mysql < [database_name] install/database.sql<br>
            </blockquote><br>






            <h3 class="mt-4 mb-4 font-bold text-lg text-blue-500">2.3 Finishing</h3>

            <ol class="list-decimal pl-8 space-y-2">
                <li>Set up a webhook from your Stripe dashboard to <span class="bg-gray-700 text-red-300 p-1 rounded">https://yourdomain.com/webhooks/stripe.php</span> to handle Stripe events.</li>

                <li>[DEVELOPERS] Set up automatic deployment from a git repository<span class="bg-gray-700 text-red-300 p-1 rounded">/webhooks/deploy.php</span>.</li>
                <li>[DEVELOPERS] If you used manual install run also: composer install-tailwind</li>
                <li>[DEVELOPERS] Tailwind is included by default, you regenerate css with
                    <blockquote class="bg-gray-900 rounded-md text-white px-6 py-4 border-1 border-gray-700">
                        composer rebuild-css
                    </blockquote>
                </li>

            </ol>
            </section>


            <h3 class="mt-4 mb-4 font-bold text-lg text-blue-500">2.4 Verification and Testing</h3>
            <p>Ensure the setup is correct by accessing the following:</p>


            <ul class="list-disc pl-8">
                <li><a href="/app" class="text-blue-400 hover:text-blue-600">Login Page</a> should open correctly.</li>
                <li><a href="/signup" class="text-blue-400 hover:text-blue-600">Signup Page</a> should receive an email with password correctly.</li>
                <li><a href="/api" class="text-blue-400 hover:text-blue-600">API Endpoint</a> should display a 'not authenticated' message.</li>
                <li>Access your main landing or marketing page at the <span class="bg-gray-700 text-red-300 p-1 rounded">/</span> directory.</li>

            </ul>


            <hr class="border-1 border-gray-800 mt-10">
            <h2 id="upgrade" class="text-xl text-blue-500 mt-10 uppercase mb-5">3. Upgrade Guide</h2>

            <p>To upgrade Stripe Pad you just need to replace core files</p>
            1- Replace core folder with the new version<br>
            2- Replace load.php with the new version (TO-DO: Move file to core/)<br>
            <hr class="border-1 border-gray-800 mt-10">

            <h2 id="introduction" class="text-xl text-blue-500 mt-10 uppercase mb-5">4. Introduction</h2>
            <p>The base of Stripe Pad is structured as a simplistic MVC (Model-View-Controller (1)) PHP application. </p>

            <p>It's main feature is to separate users from non-users or customers. It will show public content to visitors, it will allow access to users and customers to private areas.</p>


            <p><img width="500" class="mx-auto" src="https://www.stripepad.com/cdn/demo/stripe-pad-overview.png" alt="Stripe Pad Relations"></p>





            <h2 class="text-xl text-blue-500 mt-10 uppercase mb-5">Folders and files</h2>

            <h3 class="mt-4 mb-4 font-bold text-lg text-blue-500">folders</h3>
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
            <h3 class="mt-4 mb-4 font-bold text-lg text-blue-500">files</h3>
            <ul>
                <li>.htaccess</li>
                <li>config.php</li>
                <lii>index.php</lii>
                <li>load.php</li>
                <li>stripe-pad-errors.log</li>
            </ul>


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


            <hr class="border-1 border-gray-800 mt-10">

            [WRITTING IN PUBLIC. Content below this line is not reviewed. 22/12/2024 - WIP]

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

            <h2 id="extend" class="text-xl text-blue-500 mt-10 uppercase">Building on top of Stripe Pad</h2>
            <p>To create a new webhook or a cronjob, you can do it by including "sp-load.php" file. Once included you can run any included model. For example, you will be able to check if a user is registered and then execute a method from your app.</p>




            <h2 id="routes" class="text-xl text-blue-500 mt-10 uppercase mb-5">Routes</h2>
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
            <hr class="border-1 border-gray-800 mt-10">
            <h2 id="models" class="text-xl text-blue-500 mt-10 uppercase mb-5">Models</h2>
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

            <hr class="border-1 border-gray-800 mt-10">
            <h2 id="users" class="text-xl text-blue-500 mt-10 uppercase mb-5">Users</h2>

            <p>There are 4 user roles:</p>
            <ol>
                <li>- Super Admin</li>
                <li>- Visitor</li>
                <li>- Registered User</li>
                <li>- Customer (+ Registered User)</li>
            </ol>

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
            <hr class="border-1 border-gray-800 mt-10">
            <h2 id="emails" class="text-xl text-blue-500 mt-10 uppercase mb-5">Transactional Emails</h2>

            <p>An email system comes enabled by default using SMTP server. To-do: integrate other services like Mailgun.</p>
            <p>You must update settings at config.php</p>

            <h3 class="mt-4 mb-4 font-bold text-lg text-blue-500">Templates</h3>
            <p>Email templates are in /mails folder.</p>
            <ul>
                <li>Welcome</li>
                <li>Password Reset</li>
                <li>Payment received</li>
            </ul>

            <h3 class="mt-4 mb-4 font-bold text-lg text-blue-500">How to send Email or template?</h3>
            <blockquote class="bg-gray-900 rounded-md text-white px-6 py-4 border-1 border-gray-700">
                $mails = new mailsModel();<br>
                $mails->sendTemplate('welcome', $subject, $to, $data );
            </blockquote>
            <hr class="border-1 border-gray-800 mt-10">
            <h2 id="webhooks" class="text-xl text-blue-500 mt-10 uppercase">Webhooks</h2>
            <p>Facilitate automated interactions with external systems:</p>
            <ul>
                <li><strong>deploy.php</strong>: Configurable for automatic deployment via Bitbucket or Git hooks.</li>
                <li><strong>stripe.php</strong>: Endpoint for receiving events from Stripe.</li>
            </ul>
            <hr class="border-1 border-gray-800 mt-10">

            <h2 id="api" class="text-xl text-blue-500 mt-10 uppercase">Api</h2>
            <p>API comes in 2 forms, v1 and v2.</p>
            <ul>
                <li>v1: just 1 endpoint user for 1 action (search, get info, whatever...)</li>
                <li>v2: Very Simple API REST. You can instance here your models and return JSON responses</li>
            </ul>

            <p> v3 is coming, Guzzle + REST</p>

            <hr class="border-1 border-gray-800 mt-10">





            <h2 id="cdn" class="text-xl text-blue-500 mt-10 uppercase">CDN</h2>
            <h2>CDN</h2>
            <p>The 'cdn' directory is intended for static assets such as JavaScript, CSS, and images. Ideally, these should be served from a separate domain or subdomain to improve loading times and security.</p>
            <hr class="border-1 border-gray-800 mt-10">









        </main>

        <!-- Right Sidebar: On-page navigation -->
        <nav class="w-48  py-12  inset-y-0 right-0 overflow-y-auto">

        </nav>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('main a').addClass("text-blue-400 hover:underline hover:text-blue-700");
    });
</script>