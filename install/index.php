<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../cdn/css/app.css" rel="stylesheet">
    <title>Configuration Form</title>
    <style>
        body {
            font-family: 'PT Mono', 'Courier New', serif;
        }

        @font-face {
            font-family: 'AirClassicBlack';
            /* Give your font a name */
            src: url('https://cdn.gophpninja.com/fonts/airclassic.woff2') format('woff2');
            /* Specify the path to your WOFF2 file */
            font-weight: bold;
            /* Adjust font-weight if needed */
            font-style: normal;
            /* Adjust font-style if needed */
        }

        .air {
            font-family: AirClassicBlack;

        }
    </style>
</head>

<body class="bg-black py-10 text-gray-300">
    <?php
    $output = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['submit'])) {

        // Save Configuration file
        $content = "<?php\n\n";
        foreach ($_POST as $key => $value) {
            if ($key != 'submit') {
                $content .= "define('{$key}', '" . addslashes($value) . "');\n";
            }
        }
        $content .= "        
define('APP_DOMAIN', HOMEPAGE_URL);   
define('APP_BASE_URL', HOMEPAGE_URL);        
        define('ROOT_PATH', dirname(__FILE__) . '/');
define('CORE_PATH', dirname(__FILE__) . '/core/');
define('APP_PATH', dirname(__FILE__) . '/app/');
define('APP_UPLOAD_PATH', dirname(__FILE__) . '/uploads/');

        ?>";

        //file_put_contents('sp-config.php', $content);



        // IMPORT DATABASE
        $mysqli = new mysqli($_POST['APP_DB_HOST'], $_POST['APP_DB_USER'], $_POST['APP_DB_PASSWORD'], $_POST['APP_DB']);

        // Set character encoding to UTF-8
        $mysqli->set_charset("utf8");

        // Check for a successful database connection
        if ($mysqli->connect_error) {
            $output .= ('[DATABASE] Database Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error) . "<br>";
        } else {

            $sql = file_get_contents(dirname(__FILE__) . '/database.sql');
            if (!$mysqli->multi_query($sql)) {
                $output .= "[DATABASE] Database import failed: (" . $mysqli->errno . ") " . $mysqli->error . "<br>";
            } else {
                $output .= "[DATABASE] Database import completed successfully!<br>";
            }
        }


        // RUN COMPOSER: Ensure that composer is executable and the path is correctly set
        $composerCommand = 'cd ..; composer install';
        $output .= shell_exec($composerCommand . ' 2>&1') . "<br>"; // Redirect stderr to stdout to capture any errors

        // Close the database connection
        $mysqli->close();

        if (!@file_put_contents('../sp-config.php', $content)):
            $output .= "[CONFIG] Error creating config.php file. Move config.php manually to /";
    ?>

            <script>
                var content = `<?php echo $content; ?>`;

                // Convert the PHP output string to a Blob
                var blob = new Blob([content], {
                    type: 'text/plain'
                });

                // Create a URL for the Blob
                var url = window.URL.createObjectURL(blob);

                // Create a download link
                var downloadLink = document.createElement('a');
                downloadLink.href = url;
                downloadLink.download = 'sp-config.php';

                // Append the link to the document and trigger the download
                document.body.appendChild(downloadLink);
                downloadLink.click();
                document.body.removeChild(downloadLink);

                // Optionally free up the Blob URL
                window.URL.revokeObjectURL(url);
                alert("Move the sp-config.php you have just downloaded and move it to the root folder");
            </script>
    <?
        else:
            $output .= "[CONFIG] config.php saved" . "<br>";
        endif;
    }
    ?>
    <div class="max-w-xl bg-gray-900 px-6 py-6  mx-auto  text-gray-400 rounded-lg shadow-lg">
        <form action="" method="post" class="">
            <? include "../core/sp-version.php"; ?>

            <h1 class="text-xl text-blue-500 font-bold mb-4 air">Stripe Pad v. <?= $STRIPE_PAD_VERSION ?> Installer</h1>
            <!-- <p>You are a form away of signning up to your application</p> -->

            <? if (!empty($output)): ?>
                <blockquote class="bg-gray-800 text-gray-400 text-xs rounded-md py-4 px-3 mb-5">
                    Installation output:<br>
                    <?= $output ?>
                    <hr>
                    Remove /install folder afterwards
                </blockquote>
            <? else: ?>

                <p class="text-xs text-gray-500">This installer performs the following steps, if you prefer you can do it manually:</p>
                <ol class="mb-5 text-xs list">
                    <li>adjust config.php</li>
                    <li>import install/database.sql</li>
                    <li>run composer install</li>

                </ol>
                <span class='text-blue-300 text-xs'>✔︎ Requirements checklist</span>
                <blockquote class="bg-gray-800 text-gray-400 text-xs rounded-md py-4 px-3 mb-5">
                    <? if (version_compare(PHP_VERSION, '7.2', '>=')) {
                        echo "<span class='text-light-blue-300'>✔︎</span> PHP version is " . PHP_VERSION . " (>=7.2).<br>";
                    } else {
                        echo "[x] FIX: PHP version is " . PHP_VERSION . " <br>";
                    }

                    if (function_exists('system')) {
                        echo "✔︎ The 'system' function is available.<br>";
                    } else {
                        echo "The 'system' function is not available.<br>";
                    }

                    if (function_exists('exec')) {
                        echo "✔︎ The 'exec' function is available.<br>";
                    } else {
                        echo "The 'exec' function is not available.<br>";
                    }

                    if (class_exists('PDO')) {
                        $drivers = PDO::getAvailableDrivers();
                        if (in_array('mysql', $drivers)) {
                            echo "✔︎ MySQL PDO is installed.<br>";
                        } else {
                            echo "[x] MySQL PDO is not available.<br>";
                        }
                    } else {
                        echo "[x] PDO is not installed.<br>";
                    } ?>
                </blockquote>
            <? endif; ?>
            <h2 class="text-base text-blue-500 font-bold mb-4 air">General Details</h2>
            <label class="block mb-4 text-sm">
                <span class="text-gray-400">SaaS Name</span>
                <input placeholder="Stripe Pad" type="text" class="w-full p-2 rounded bg-gray-800 border border-gray-700" name="APP_NAME" value="<?php echo defined('APP_NAME') ? APP_NAME : ''; ?>">
            </label>
            <label class="block mb-4 text-sm">
                <span class="text-gray-400">Base URL</span>
                <input placeholder="https://www.stripepad.com" type="url" class=" w-full p-2 rounded bg-gray-800 border border-gray-700" name="HOMEPAGE_URL">
                <p class="text-xs text-gray-500">Base url will show the landing and public pages. /app will show the private ones</p>
            </label>


            <label class="block mb-4 text-sm">
                <span class="text-gray-400">SaaS Logo</span>
                <input placeholder="https://stripepad.com/cdn/img/logo.png" type="url" class="w-full p-2 rounded bg-gray-800 border border-gray-700" name="APP_LOGO" value="<?php echo defined('APP_LOGO') ? APP_LOGO : ''; ?>">
                <p class="text-xs text-gray-500">Used also in mail templates /mails</p>
            </label>



            <label class="block mb-4 text-sm">
                <span class="text-gray-400">SEO Title</span>
                <input placeholder="Stripe Pad · PHP Micro Saas Boilerplate" type="text" class="w-full p-2 rounded bg-gray-800 border border-gray-700" name="SEO_TITLE" value="<?php echo defined('SEO_TITLE') ? SEO_TITLE : ''; ?>">
            </label>

            <label class="block mb-4 text-sm">
                <span class="text-gray-400">SEO Description</span>
                <input type="text" placeholder="A simple PHP SaaS boilerplate to validate your ideas faster." class="w-full p-2 rounded bg-gray-800 border border-gray-700" name="SEO_DESCRIPTION" value="<?php echo defined('SEO_DESCRIPTION') ? SEO_DESCRIPTION : ''; ?>">
            </label>



            <h3 class="text-base text-blue-500 font-bold mb-4 air">E-mail Settings</h3>
            <label class="block mb-4 text-sm">
                <span class="text-gray-400">SMTP Server</span>
                <input type="text" class="w-full p-2 rounded bg-gray-800 border border-gray-700" name="SMTP_SERVER" value="<?php echo defined('SMTP_SERVER') ? SMTP_SERVER : ''; ?>">
            </label>

            <label class="block mb-4 text-sm">
                <span class="text-gray-400">SMTP Port</span>
                <input type="text" class="w-full p-2 rounded bg-gray-800 border border-gray-700" name="SMTP_PORT" value="<?php echo defined('SMTP_PORT') ? SMTP_PORT : ''; ?>">
            </label>

            <label class="block mb-4 text-sm">
                <span class="text-gray-400">SMTP User</span>
                <input type="text" class="w-full p-2 rounded bg-gray-800 border border-gray-700" name="SMTP_USER" value="<?php echo defined('SMTP_USER_EMAIL') ? SMTP_USER_EMAIL : ''; ?>">
            </label>

            <label class="block mb-4 text-sm">
                <span class="text-gray-400">SMTP Password</span>
                <input type="text" class="w-full p-2 rounded bg-gray-800 border border-gray-700" name="SMTP_PASSWORD" value="<?php echo defined('SMTP_PASSWORD') ? SMTP_PASSWORD : ''; ?>">
            </label>



            <h3 class="text-base text-blue-500 font-bold mb-4 air">Database Settings</h3>

            <label class="block mb-4 text-sm">
                <span class="text-gray-400">MySQL Database Host</span>
                <input type="text" class="w-full p-2 rounded bg-gray-800 border border-gray-700" name="APP_DB_HOST" value="<?php echo defined('APP_DB_HOST') ? APP_DB_HOST : ''; ?>">
            </label>

            <label class="block mb-4 text-sm">
                <span class="text-gray-400">Database Name</span>
                <input type="text" class="w-full p-2 rounded bg-gray-800 border border-gray-700" name="APP_DB" value="<?php echo defined('APP_DB') ? APP_DB : ''; ?>">
            </label>

            <label class="block mb-4 text-sm">
                <span class="text-gray-400">Database Login Username</span>
                <input type="text" class="w-full p-2 rounded bg-gray-800 border border-gray-700" name="APP_DB_USER" value="<?php echo defined('APP_DB_USER') ? APP_DB_USER : ''; ?>">
            </label>

            <label class="block mb-4 text-sm">
                <span class="text-gray-400">Database Login Password</span>
                <input type="text" class="w-full p-2 rounded bg-gray-800 border border-gray-700" name="APP_DB_PASSWORD" value="<?php echo defined('APP_DB_PASSWORD') ? APP_DB_PASSWORD : ''; ?>">
            </label>
            <h3 class="text-base text-blue-500 font-bold mb-4 air">[PROD] Stripe Production Keys</h3>
            <p class="text-xs mb-5">Stripe is the external service we will use to process payments and subscriptions. If you don't have an account signup at <a href="https://stripe.com/?ref=stripepad.com" target="_blank">stripe.com</a></p>
            <!-- Stripe Details -->
            <label class="block mb-4 text-sm">
                <span class="text-gray-400">Stripe Public Key</span>
                <input type="text" class="w-full p-2 rounded bg-gray-800 border border-gray-700" name="APP_STRIPE_PUBKEY" value="<?php echo defined('APP_STRIPE_PUBKEY') ? APP_STRIPE_PUBKEY : ''; ?>">
            </label>

            <label class="block mb-4 text-sm">
                <span class="text-gray-400">Stripe Secret Key</span>
                <input type="text" class="w-full p-2 rounded bg-gray-800 border border-gray-700" name="APP_STRIPE_SECRETKEY" value="<?php echo defined('APP_STRIPE_SECRETKEY') ? APP_STRIPE_SECRETKEY : ''; ?>">
            </label>

            <label class="block mb-4 text-sm">
                <span class="text-gray-400">Stripe Webhook Secret</span>
                <input type="text" class="w-full p-2 rounded bg-gray-800 border border-gray-700" name="APP_STRIPE_WEBHOOK_SECRET" value="<?php echo defined('APP_STRIPE_WEBHOOK_SECRET') ? APP_STRIPE_WEBHOOK_SECRET : ''; ?>">
            </label>
            <label class="block mb-4 text-sm">
                <span class="text-gray-400">Stripe Tax Rate</span>
                <input placeholder="tx_xxxxxxx" type="text" class="w-full p-2 rounded bg-gray-800 border border-gray-700" name="APP_STRIPE_TAX_RATE" value="<?php echo defined('APP_STRIPE_TAX_RATE') ? APP_STRIPE_TAX_RATE : ''; ?>">
            </label>
            <h3 class="text-base text-blue-500 font-bold mb-4 air">[TEST] Stripe Test Keys</h3>
            <label class="block mb-4 text-sm">
                <span class="text-gray-400">Stripe Public Key Test</span>
                <input type="text" class="w-full p-2 rounded bg-gray-800 border border-gray-700" name="APP_STRIPE_PUBKEY_TEST" value="<?php echo defined('APP_STRIPE_PUBKEY_TEST') ? APP_STRIPE_PUBKEY_TEST : ''; ?>">
            </label>

            <label class="block mb-4 text-sm">
                <span class="text-gray-400">Stripe Secret Key Test</span>
                <input type="text" class="w-full p-2 rounded bg-gray-800 border border-gray-700" name="APP_STRIPE_SECRETKEY_TEST" value="<?php echo defined('APP_STRIPE_SECRETKEY_TEST') ? APP_STRIPE_SECRETKEY_TEST : ''; ?>">
            </label>

            <label class="block mb-4 text-sm">
                <span class="text-gray-400">Stripe Webhook Secret Test</span>
                <input type="text" class="w-full p-2 rounded bg-gray-800 border border-gray-700" name="APP_STRIPE_WEBHOOK_SECRET_TEST" value="<?php echo defined('APP_STRIPE_WEBHOOK_SECRET_TEST') ? APP_STRIPE_WEBHOOK_SECRET_TEST : ''; ?>">
            </label>

            <!-- 
            <input type="hidden" name="DEBUG_MODE" value="true">
            <input type="hidden" name="CORE_PATH" value="true">
            <input type="hidden" name="APP_PATH" value="true">
            <input type="hidden" name="APP_UPLOAD_PATH" value="true">
            <input type="hidden" name="APP_DOMAIN" value="true">
            <input type="hidden" name="APP_BASE_URL" value="true">
            <input type="hidden" name="HOMEPAGE_URL" value="true"> -->


            <input type="submit" name="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mb-5" value="Install my SaaS">
            <p class="text-xs text-gray-400 pt-10">Config.php file will be created, composer run and tables imported to database. In case you need to change anything, edit config.php later.</p>
            <a href="https://www.stripepad.com">stripepad.com</a>
        </form>




    </div>




</body>

</html>