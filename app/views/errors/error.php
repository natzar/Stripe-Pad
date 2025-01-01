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
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }

        .terminal-cursor {
            animation: blink 1s step-end infinite;
        }
    </style>
</head>

<body class="bg-gray-800 text-blue-400 font-mono pt-10 text-center">
    <div class="p-8 text-left space-y-2 max-w-4xl mx-auto bg-gray-100 rounded-xl shadow-xl">
        <p>[Stripe Pad] <span class="text-blue-600">An error occurred</span></p>
        <hr>

        <p class="text-gray-800"><?= nl2br($error_msg) ?> </p>
        <hr>
        <br>

        <p>
            <a class="bg-sky-600 hover:bg-sky-900 text-base text-white py-2 px-4 rounded-full shadow-xl" href="#" onclick="window.location.reload();">Reload</a>

            <a class="bg-sky-800 hover:bg-sky-900 text-base text-white py-2 px-4 rounded-full shadow-xl" href="https://github.com/natzar/Stripe-Pad/issues/new?assignees=&labels=&projects=&template=bug_report.md&title=" target="_blank">Report Issue</a>
        </p>


    </div>
    <p class="text-xs text-gray-500 mt-5"> Stripe Pad v.<?= STRIPE_PAD_VERSION ?> · stripepad.com </p>
</body>

</html>