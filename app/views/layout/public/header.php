<?php
/* Header */
?><!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <title><?= $SEO_TITLE ?></title>
  <meta name="title" content="<?= $SEO_TITLE ?>">
  <meta charset='utf-8'>
  <meta name="author" content="Beto Ayesa">
  <meta name="description" content="<?= $SEO_DESCRIPTION ?>">
  <link rel="canonical" href="<?= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>">

  <meta name="keywords" content="<?= implode(",", explode(" ", $SEO_TITLE)) ?>">
  <meta property="og:title" content="<?= $SEO_TITLE ?>" />
  <meta property="og:type" content="website" />
  <meta property="og:image" content="https://www.stripepad.com/cdn/img/open-graph.png" />
  <meta property="og:url" content="<?= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>" />
  <meta property="og:description" content="<?= $SEO_DESCRIPTION ?>" />
  <meta property="og:site_name" content="Domstry" />

  <meta name="twitter:card" content="summary" />
  <meta name="twitter:site" content="@betoayesa" />
  <meta name="twitter:title" content="<?= $SEO_TITLE ?>" />
  <meta name="twitter:description" content="<?= $SEO_DESCRIPTION ?>" />
  <meta name="twitter:image" content="https://www.stripepad.com/cdn/img/open-graph.png" />
  <meta name="twitter:creator" content="@betoayesa" />

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">

  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="theme-color" content="#ffffff">

  <base href="<?= APP_BASE_URL ?>">

  <!-- MAIN CSS -->
  <link href="<?= APP_CDN ?>css/app.css?v=<?= rand() ?>" rel="stylesheet">
  <!-- <link rel="preconnect" href="https://fonts.googleapis.com"> -->
  <!-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
  <!-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@800&display=swap" rel="stylesheet"> -->

  <style>
    html {
      scroll-behavior: smooth;
    }

    .nunito {
      /*	font-family: 'Nunito',sans-serif;*/
      font-family: Inter var, ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
      font-feature-settings: "cv02", "cv03", "cv04", "cv11";
      -webkit-font-smoothing: antialiased;
      font-weight: 600;
    }

    html,
    body {
      font-family: Inter var, ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
      font-feature-settings: "cv02", "cv03", "cv04", "cv11";
      -webkit-font-smoothing: antialiased;
    }
 
    @font-face {
      font-family: 'AirClassicMedium';
      /* Give your font a name */
      src: url('https://cdn.gophpninja.com/fonts/airclassic-medium.woff2') format('woff2');
      /* Specify the path to your WOFF2 file */
      font-weight: normal;
      /* Adjust font-weight if needed */
      font-style: normal;
      /* Adjust font-style if needed */
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

    html,
    body {
      font-family: 'PT Mono', serif !important;
      /* Use your custom font for the body or any specific element */
    }

    h1,
    h2,
    h3,
    h4,
    strong,
    .font-black {
      font-family: 'AirClassicBlack' !important;
      font-weight: 600
    }

    .font-medium {
      font-family: 'AirClassicMedium';
    }
  </style>

  <!-- Include here your JS -->
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>


  <? if ($page == "app.php"): ?>
    <!-- header hardcoded hook: custom code exclusive for your app -->
  <? endif; ?>
</head>

<body class="bg-gray-900">

<?php if (!empty($_SESSION['errors']) and count($_SESSION['errors']) > 0): ?>


    <div id="modal-alert" class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
      <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

      <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
          <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
            <div class="sm:flex sm:items-start">
              <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-sky-100 sm:mx-0 sm:h-10 sm:w-10">
                <svg class="h-6 w-6 text-sky-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>
              </div>
              <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title"><?= APP_NAME ?> </h3>
                <div class="mt-2">
                  <?php foreach ($_SESSION['errors'] as  $v): ?>
                    <p class="text-sm text-gray-500"><?= $v ?></p>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
              <button type="button" onclick="$('#modal-alert').addClass('hidden');" class="inline-flex w-full justify-center rounded-md bg-sky-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-sky-500 sm:ml-3 sm:w-auto">Cerrar</button>
            </div>
          </div>

        </div>
      </div>
    </div>

  <?php endif; ?>

  <?php if (!empty($_SESSION['alerts']) and count($_SESSION['alerts']) > 0): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
      <?php foreach ($_SESSION['alerts'] as $v): ?>
        <span class="block sm:inline"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 inline">
            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
          </svg>

          <?= $v ?></span><br>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>