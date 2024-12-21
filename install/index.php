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