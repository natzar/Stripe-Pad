<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title><?= $SEO_TITLE ?></title>
<meta name="title" content="<?= $SEO_TITLE ?>">
<meta charset='utf-8'>  
<meta name="author" content="Beto Ayesa">
<meta name="description" content="<?= $SEO_DESCRIPTION ?>">
<link rel="canonical" href="<?= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>">

<meta name="keywords" content="<?= implode(",",explode(" ",$SEO_TITLE)) ?>">
<meta property="og:title" content="<?= $SEO_TITLE ?>" />
<meta property="og:type" content="website" />
<meta property="og:image" content="https://www.domstry.com/domstry-share.png" />
<meta property="og:url" content="<?= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>" />
<meta property="og:description" content="<?= $SEO_DESCRIPTION ?>" />
<meta property="og:site_name" content="Domstry" />

<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@betoayesa" />
<meta name="twitter:title" content="<?= $SEO_TITLE ?>" />
<meta name="twitter:description" content="<?= $SEO_DESCRIPTION ?>" />
<meta name="twitter:image" content="https://www.domstry.com/domstry-share.png" />
<meta name="twitter:creator" content="@betoayesa" />


<!DOCTYPE html>
<html>
  <head>
    <title>Stripe Pad</title>
    <meta name="title" content="Stripe Pad">
    <meta name="author" content="Php Ninja">
    <meta name="description" content="Stripe Pad, create a public shop from your Stripe products in a minute">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset='utf-8'>
    <meta property="og:title" content="Stripe Pad">
    <meta property="og:image" content="https://stripepad.com/main-stripepad.png">
    <meta property="og:url" content="https://stripepad.com">
    <meta name="og:description" content="Stripe Pad, create a public shop from your Stripe products in a minute">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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
<base href="<?= APP_BASE_URL ?>">

<!-- CSS -->
<script src="https://cdn.tailwindcss.com"></script>
<link href="<?= APP_BASE_URL ?>app/themes/<?= APP_THEME ?>/app.css" rel="stylesheet"> 

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@800&display=swap" rel="stylesheet">

<!-- Favicon* -->
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
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

<!-- Hardcoded SS -->
<style>
	html{
	scroll-behavior: smooth;
}
.nunito{
	font-family: 'Nunito',sans-serif;
	font-weight: 600;
}
.custom-green{
    color:#41B883;
}
</style>

<!-- PHP to JS -->
<script>
    var isAuthorized = <?= $isAuthenticated ? 1:0 ?>;
    var base_url = '<?= APP_BASE_URL?>';

</script>

<!-- Include here your JS -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js" async></script>


<? if ($page == "app.php"): ?>
<!-- header hardcoded hook: custom code exclusive for your app -->
<? endif; ?>
</head>
 <body class="bg-black">


   


