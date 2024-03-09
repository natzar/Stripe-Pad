<!DOCTYPE html>
<html lang="en">
<head>
	<script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "idnk48da84");
</script>
	<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-YW95P8LXSV"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-YW95P8LXSV');
</script>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title><?= $title ?></title>
<meta name="title" content="<?= $title ?>">
<meta name="author" content="Php Ninja">
<meta name="description" content="<?= $SEO_DESCRIPTION ?>">
<link rel="canonical" href="<?= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset='utf-8'>  
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
<link href="app/domain.database.css?v=<?= Date("Ymd") ?>" rel="stylesheet">


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



<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@800&display=swap" rel="stylesheet">

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
<meta name="keywords" content="<?= implode(",",explode(" ",$SEO_TITLE)) ?>">

<style>
	html{
	scroll-behavior: smooth;
}
.nunito{
	font-family: 'Nunito',sans-serif;
	font-weight: 600;
}
</style>
</head>
 <body class="bg-black">
<? include "menu.php"; ?>

   

<div class=" px-6 py-24 sm:pt-32 sm:pb-16 lg:px-8 border-gray-800 border-b">
  <div class="mx-auto max-w-2xl text-center">
    <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl nunito"><?= $title ?></h1>
    <!-- <p class="mt-6 text-lg leading-8 text-gray-300">If you are working with domains you may find these links interesting</p> -->
  </div>
</div>



<div class=" px-6 pt-16 lg:px-8">
  <div class="mx-auto max-w-3xl text-base leading-7 text-gray-600">
    
    
    <div class="article  max-w-2xl text-base leading-7">
    
    	<?= $body ?>
     
    <div class="mt-16 max-w-2xl">
      <h2 class="text-2xl font-bold tracking-tight text-gray-300">Everything you need to get up and running</h2>
      <p class="mt-6"><a class="underline text-green-600" href="https://www.domstry.com">domstry.com</a> offers a comprehensive domain database that provides valuable insights into domain expiration dates, contact information, hosting details, and technologies used by various domains. This constantly updated database serves as a critical tool for market research and enhancing digital marketing strategies, giving users a competitive advantage in the domain industry. It's an opportunity for businesses to access current, accurate information, enabling informed decision-making and business growth.
</p>

    </div>
  </div>
</div>
</div>

<? $HOOK_JS = "$('.article h2,.article strong,.article h3').addClass('font-bold text-gray-300 mt-4');$('.article h3, .article li').addClass('mt-5');"; ?>
<? include "footer.php"; ?>