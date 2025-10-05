<?php
/* Header */
?>
<!DOCTYPE html>
<html lang="<?= LOCALE_LANG ?>">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $SEO_TITLE ?></title>
  <meta name="title" content="<?= $SEO_TITLE ?>">
  <meta charset='utf-8'>
  <meta name="author" content="Stripe Pad">
  <meta name="description" content="<?= $SEO_DESCRIPTION ?>">
  <link rel="canonical" href="<?= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>">

  <meta name="keywords" content="<?= implode(",", explode(" ", $SEO_TITLE)) ?>">
  <meta property="og:title" content="<?= $SEO_TITLE ?>" />
  <meta property="og:type" content="website" />
  <meta property="og:image" content="<?= APP_CDN ?>img/open-graph.png" />
  <meta property="og:url" content="<?= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>" />
  <meta property="og:description" content="<?= $SEO_DESCRIPTION ?>" />
  <meta property="og:site_name" content="Stripe Pad | Micro SaaS" />

  <meta name="twitter:card" content="summary" />

  <meta name="twitter:title" content="<?= $SEO_TITLE ?>" />
  <meta name="twitter:description" content="<?= $SEO_DESCRIPTION ?>" />
  <meta name="twitter:image" content="<?= APP_CDN ?>img/open-graph.webp" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">


  <base href="<?= APP_BASE_URL ?>">

  <!-- MAIN CSS -->
  <link href="<?= APP_CDN ?>css/app.css" rel="stylesheet">
  <link href="<?= APP_CDN ?>css/custom.css" rel="stylesheet">
  <!-- <link rel="preconnect" href="https://fonts.googleapis.com"> -->
  <!-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
  <!-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@800&display=swap" rel="stylesheet"> -->


  <!-- Include here your JS -->
  <script src="<?= APP_CDN ?>js/jquery-1.12.4.min.js"></script>


</head>

<body class="bg-white">