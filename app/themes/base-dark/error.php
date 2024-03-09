<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Additional custom styles to enhance the terminal look */
        @keyframes blink {
            from { opacity: 1; }
            to { opacity: 0; }
        }
        .terminal-cursor {
            animation: blink 1s step-end infinite;
        }
    </style>
</head>
<body class="bg-black text-green-400 font-mono">
    <div class="p-4 space-y-2 max-w-4xl mx-auto">
        <p>[Stripe Pad] <span class="text-green-600">An error occurred</span></p>
        <!-- <p>[user@phpninja html]$ <span class="text-green-600">ls -la</span></p> -->
        <!-- <div class="bg-green-800 bg-opacity-25 p-2">
            <p>-rw-r--r-- 1 user user 11321 Mar  3 12:45 index.html</p>
            <p>-rw-r--r-- 1 user user 13458 Mar  3 12:45 style.css</p>
            <p class="text-red-500">-rw-r--r-- 1 user user     0 Mar  3 12:45 error.log</p>
        </div>
         --><p class="text-red-500">ERROR: </p>
        <p class="text-red-500"><?= nl2br($error_msg)?> </p>
        <p>[developer@stripepad]$ <span class="blink-cursor">_</span></p>
    </div>
</body>
</html>
