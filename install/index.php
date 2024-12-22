<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0-alpha.3/dist/tailwind.min.css" rel="stylesheet">
    <title>Configuration Form</title>
</head>

<body class="bg-gray-200 py-10">
    <div class="max-w-xl mx-auto px-8">
        <form action="" method="post" class="bg-white p-5 shadow rounded">
            <h1 class="text-xl font-bold mb-4">Edit Configuration</h1>

            <label class="block mb-4">
                <span class="text-gray-700">Stripe Pad Version</span>
                <input type="text" name="STRIPE_PAD_VERSION" value="<?php echo defined('STRIPE_PAD_VERSION') ? STRIPE_PAD_VERSION : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">App Name</span>
                <input type="text" name="APP_NAME" value="<?php echo defined('APP_NAME') ? APP_NAME : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">App Slug</span>
                <input type="text" name="APP_SLUG" value="<?php echo defined('APP_SLUG') ? APP_SLUG : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">App Logo</span>
                <input type="text" name="APP_LOGO" value="<?php echo defined('APP_LOGO') ? APP_LOGO : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">App Theme</span>
                <input type="text" name="APP_THEME" value="<?php echo defined('APP_THEME') ? APP_THEME : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">SEO Title</span>
                <input type="text" name="SEO_TITLE" value="<?php echo defined('SEO_TITLE') ? SEO_TITLE : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">SEO Description</span>
                <input type="text" name="SEO_DESCRIPTION" value="<?php echo defined('SEO_DESCRIPTION') ? SEO_DESCRIPTION : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">Bot Blocker</span>
                <input type="checkbox" name="BOT_BLOCKER" <?php echo defined('BOT_BLOCKER') && BOT_BLOCKER ? 'checked' : ''; ?> class="mt-1">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">Admin Email</span>
                <input type="text" name="ADMIN_EMAIL" value="<?php echo defined('ADMIN_EMAIL') ? ADMIN_EMAIL : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">SMTP Server</span>
                <input type="text" name="SMTP_SERVER" value="<?php echo defined('SMTP_SERVER') ? SMTP_SERVER : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">SMTP Port</span>
                <input type="text" name="SMTP_PORT" value="<?php echo defined('SMTP_PORT') ? SMTP_PORT : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">SMTP User</span>
                <input type="text" name="SMTP_USER" value="<?php echo defined('SMTP_USER') ? SMTP_USER : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">SMTP Password</span>
                <input type="password" name="SMTP_PASSWORD" value="<?php echo defined('SMTP_PASSWORD') ? SMTP_PASSWORD : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">Homepage URL</span>
                <input type="text" name="HOMEPAGE_URL" value="<?php echo defined('HOMEPAGE_URL') ? HOMEPAGE_URL : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">App CDN</span>
                <input type="text" name="APP_CDN" value="<?php echo defined('APP_CDN') ? APP_CDN : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">App Table Prefix</span>
                <input type="text" name="APP_TABLE_PREFIX" value="<?php echo defined('APP_TABLE_PREFIX') ? APP_TABLE_PREFIX : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">App DB Host</span>
                <input type="text" name="APP_DB_HOST" value="<?php echo defined('APP_DB_HOST') ? APP_DB_HOST : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">App DB</span>
                <input type="text" name="APP_DB" value="<?php echo defined('APP_DB') ? APP_DB : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">App DB User</span>
                <input type="text" name="APP_DB_USER" value="<?php echo defined('APP_DB_USER') ? APP_DB_USER : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">App DB Password</span>
                <input type="password" name="APP_DB_PASSWORD" value="<?php echo defined('APP_DB_PASSWORD') ? APP_DB_PASSWORD : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <!-- Stripe Details -->
            <label class="block mb-4">
                <span class="text-gray-700">Stripe Public Key</span>
                <input type="text" name="APP_STRIPE_PUBKEY" value="<?php echo defined('APP_STRIPE_PUBKEY') ? APP_STRIPE_PUBKEY : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">Stripe Secret Key</span>
                <input type="text" name="APP_STRIPE_SECRETKEY" value="<?php echo defined('APP_STRIPE_SECRETKEY') ? APP_STRIPE_SECRETKEY : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">Stripe Webhook Secret</span>
                <input type="text" name="APP_STRIPE_WEBHOOK_SECRET" value="<?php echo defined('APP_STRIPE_WEBHOOK_SECRET') ? APP_STRIPE_WEBHOOK_SECRET : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>
            <label class="block mb-4">
                <span class="text-gray-700">Stripe Public Key Test</span>
                <input type="text" name="APP_STRIPE_PUBKEY_TEST" value="<?php echo defined('APP_STRIPE_PUBKEY_TEST') ? APP_STRIPE_PUBKEY_TEST : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">Stripe Secret Key Test</span>
                <input type="text" name="APP_STRIPE_SECRETKEY_TEST" value="<?php echo defined('APP_STRIPE_SECRETKEY_TEST') ? APP_STRIPE_SECRETKEY_TEST : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">Stripe Webhook Secret Test</span>
                <input type="text" name="APP_STRIPE_WEBHOOK_SECRET_TEST" value="<?php echo defined('APP_STRIPE_WEBHOOK_SECRET_TEST') ? APP_STRIPE_WEBHOOK_SECRET_TEST : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">Stripe Account Country</span>
                <input type="text" name="APP_STRIPE_ACCOUNTCOUNTRY" value="<?php echo defined('APP_STRIPE_ACCOUNTCOUNTRY') ? APP_STRIPE_ACCOUNTCOUNTRY : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">Stripe Currency</span>
                <input type="text" name="APP_STRIPE_CURRENCY" value="<?php echo defined('APP_STRIPE_CURRENCY') ? APP_STRIPE_CURRENCY : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">Stripe Default Country</span>
                <input type="text" name="APP_STRIPE_DEFAULTCOUNTRY" value="<?php echo defined('APP_STRIPE_DEFAULTCOUNTRY') ? APP_STRIPE_DEFAULTCOUNTRY : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">Stripe Tax Rate</span>
                <input type="text" name="APP_STRIPE_TAX_RATE" value="<?php echo defined('APP_STRIPE_TAX_RATE') ? APP_STRIPE_TAX_RATE : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <!-- Paths -->
            <label class="block mb-4">
                <span class="text-gray-700">Root Path</span>
                <input type="text" name="ROOT_PATH" value="<?php echo defined('ROOT_PATH') ? ROOT_PATH : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">Core Path</span>
                <input type="text" name="CORE_PATH" value="<?php echo defined('CORE_PATH') ? CORE_PATH : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">App Path</span>
                <input type="text" name="APP_PATH" value="<?php echo defined('APP_PATH') ? APP_PATH : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">App Upload Path</span>
                <input type="text" name="APP_UPLOAD_PATH" value="<?php echo defined('APP_UPLOAD_PATH') ? APP_UPLOAD_PATH : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <!-- Localization -->
            <label class="block mb-4">
                <span class="text-gray-700">Internal Encoding</span>
                <input type="text" name="INTERNAL_ENCODING" value="<?php echo defined('INTERNAL_ENCODING') ? INTERNAL_ENCODING : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">Timezone</span>
                <input type="text" name="TIMEZONE" value="<?php echo defined('TIMEZONE') ? TIMEZONE : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">Locale Language</span>
                <input type="text" name="LOCALE_LANG" value="<?php echo defined('LOCALE_LANG') ? LOCALE_LANG : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">Locale Time</span>
                <input type="text" name="LOCALE_TIME" value="<?php echo defined('LOCALE_TIME') ? LOCALE_TIME : ''; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </label>

            <button type="submit" name="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">Submit</button>
        </form>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $content = "<?php\n\n";
        foreach ($_POST as $key => $value) {
            if ($key != 'submit') {
                $content .= "define('{$key}', '" . addslashes($value) . "');\n";
            }
        }
        $content .= "?>";
        file_put_contents('config.php', $content);
    }
    ?>
</body>

</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $configContent = "<?php\n";
    foreach ($_POST as $key => $value) {
        $configContent .= "define('" . $key . "', '" . addslashes($value) . "');\n";
    }
    $configContent .= "?>";

    // Save to config.php
    file_put_contents('config.php', $configContent);

    // Create a new MySQLi object for database interaction
    $mysqli = new mysqli('HOST', 'USERNAME', 'PASSWORD', 'DATABASE');

    // Set character encoding to UTF-8
    $mysqli->set_charset("utf8");

    // Check for a successful database connection
    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
    }

    // Assuming SQL file is in the same directory and named 'database.sql'
    $sql = file_get_contents('database.sql');
    if (!$mysqli->multi_query($sql)) {
        echo "Database import failed: (" . $mysqli->errno . ") " . $mysqli->error;
    } else {
        echo "Installation completed successfully!";
    }

    // Close the database connection
    $mysqli->close();
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Stripe Pad Installation</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-800 min-h-screen flex items-center justify-center">
    <div class="container max-w-md mx-auto p-8 bg-gray-900 text-white rounded-lg shadow-lg">
        <h1 class="text-blue-400 text-2xl text-center mb-6">Stripe Pad Installation</h1>
        <form action="install.php" method="post">

            <div class="mb-6">
                <h2 class="text-blue-300 text-lg mb-2">General Settings</h2>
                <button type="submit" name="save_general" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Save</button>
            </div>

            <div class="mb-6">
                <h2 class="text-blue-300 text-lg mb-2">Database Settings</h2>
                <label for="db_host" class="block mb-2">Database Host:</label>
                <input type="text" id="db_host" name="db_host" required placeholder="e.g., localhost" class="w-full p-2 rounded bg-gray-800 border border-gray-700">
                <label for="db_user" class="block mb-2 mt-4">Database User:</label>
                <input type="text" id="db_user" name="db_user" required placeholder="e.g., root" class="w-full p-2 rounded bg-gray-800 border border-gray-700">
                <label for="db_password" class="block mb-2 mt-4">Database Password:</label>
                <input type="password" id="db_password" name="db_password" placeholder="Database Password" class="w-full p-2 rounded bg-gray-800 border border-gray-700">
                <label for="db_name" class="block mb-2 mt-4">Database Name:</label>
                <input type="text" id="db_name" name="db_name" required placeholder="e.g., stripe_pad" class="w-full p-2 rounded bg-gray-800 border border-gray-700">
                <button type="submit" name="save_db" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mt-4">Save</button>
            </div>

            <div>
                <h2 class="text-blue-300 text-lg mb-2">Database Installation</h2>
                <button type="submit" name="import_db" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Import</button>
            </div>

        </form>
    </div>
</body>

</html>