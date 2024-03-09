<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= APP_NAME ?></title>	   
	<link href="https://cdn.gophpninja.com/tailwind.v3.min.css?v=5" rel="stylesheet">
	<link href="https://cdn.gophpninja.com/tw-forms.css" rel="stylesheet">
	<link href="<?= APP_BASE_URL ?>assets/app.css" rel="stylesheet">
	<link href="<?= APP_BASE_URL ?>assets/jquery-ui.min.css" rel="stylesheet">

	<link rel="canonical" href="<?= $_SERVER['PHP_SELF'] ?>">
	<meta name="robots" content="noindex">
	<link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

  </head>
  <body class=" bg-gray-100">
	
	<script src="cdn/jquery-1.11.2/jquery-1.11.2.min.js"></script>
  	<script src="cdn/jquery-ui.min.js"></script>
 

	<? if (!empty($_SESSION['errors'])): ?>
	<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
	  <strong class="font-bold">Alerta</strong>
	  <span class="block sm:inline"><?= $_SESSION['errors'] ?></span>
	  <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
	    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
	  </span>
	</div>
	<? endif; ?>