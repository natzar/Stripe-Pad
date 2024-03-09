<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Simple Referrals Widget | RefBoost</title>
    <meta name="title" content="Referrals Widget | RefBoost">
    <meta name="description" content="A simple referrals widget is a tool to convert your visitors into referrers">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link href="referrals-widget.css?v=<?= rand() ?>" rel="stylesheet">
    <link rel="canonical" href="https://refboost.com"/>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  </head>
<!-- This example requires Tailwind CSS v3.0+ -->
<body>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-E6VRXLNPBZ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-E6VRXLNPBZ');
</script>

<div class="bg-white">
  

    
      
<div class="relative overflow-hidden">
    <header class="relative">
      <div class="bg-white p-6">
        <nav class="relative mx-auto flex max-w-7xl items-center justify-between px-6" aria-label="Global">
          <div class="flex flex-1 items-center">
            <div class="flex w-full items-center justify-between md:w-auto">
              <a href="#">
                <span class="sr-only">RefBoost</span>
                <img class="h-8 w-auto sm:h-10" src="refboost-logo.png" alt="">
              </a>
             
            </div>
            <div class="hidden space-x-8 md:ml-10 md:flex">
              <a href="#" onclick="refboost.init(); return false;" class="text-base font-medium text-gray-900 hover:text-gray-300">Try it</a>
              <a href="blog/ideas-referrals-widget.php" class="text-base font-medium text-gray-900 hover:text-gray-300">Use Cases</a>

              <a href="#pricing" class="text-base font-medium text-gray-900 hover:text-gray-300">Pricing</a>
              <a href="#faq" class="text-base font-medium text-gray-900 hover:text-gray-300">Frequently Asked Questions</a>
              <a href="mailto:support@refboost.com" class="text-base font-medium text-gray-900 hover:text-gray-300">support@refboost.com</a>
            </div>
          </div>
          <div class="hidden md:flex md:items-center md:space-x-6">
          <!--   <a href="#" class="text-base font-medium text-white hover:text-gray-300">Log in</a>
            <a href="#" onclick="$('#modal_signup').fadeIn();" class="inline-flex items-center rounded-md border border-transparent bg-gray-600 px-4 py-2 text-base font-medium text-white hover:bg-gray-700">Start free trial</a> -->
            <a href="https://www.producthunt.com/posts/refboost?utm_source=badge-featured&utm_medium=badge&utm_souce=badge-refboost" target="_blank"><img src="https://api.producthunt.com/widgets/embed-image/v1/featured.svg?post_id=430880&theme=light" alt="RefBoost - &#0032;Simple&#0032;word&#0032;of&#0032;mouth&#0032;Boost&#0032;with&#0032;a&#0032;referrals&#0032;widget | Product Hunt" style="width: 250px; height: 54px;" width="250" height="54" /></a>
          </div>
        </nav>
      </div>

     
      </div>
    </header>
</div>
</div>
  <?php

if (isset($_POST['submit'])): 

	include "emailValidator/emailValidator.php";

	$emailValidator = new emailValidator();

	if ($emailValidator->isValid($_POST['email']) and empty($_POST['name'])):
//  print_r($_POST);
$settings = '{
    "url": "yourdomain.com",
    "submit": "",
    "body_main": "Hi {{name}}!\r\n\r\nThanks for sharing our product.\r\nYou can use this coupon code DISCOUNTOFF20 to get your discount!\r\n\r\nYour friends have been notified and got another discount coupon (-10% off) thanks to you \r\n",
    "button_cta": "GET COUPON",
    "deal_title": "Hi there!",
    "max_friends": "3",
    "body_friends": "Your friend {{name}},\r\n\r\nWants to share with you Ref Boost, a tool to convert your visitors into referrers.\r\nYou can try it for free, but if you want the premium license you can use discount 10OFF to get a 10% discount!\r\n\r\nCheck it out: www.refboost.com\r\n",
    "primary_color": "#493df0",
    "deal_description": "Share it with 3 friends and get a $40 off for life"
}';

  include "./widget/bd.php";

  $sha1= sha1($_POST['email']);
  $q = $bd->prepare("insert into users (hash,email,settings) VALUES (:hash,:email,:settings)");
  $q->bindParam(":email",$_POST['email']);
  $q->bindParam(":hash",$sha1);
  $q->bindParam(":settings",$settings);

  //$q->bindParam(":url",$_POST['url']);
  $q->execute();

  $body= "
  Welcome to RefBoost,
  <br><br>
  Please click this link to customize your widget and get the line to copy paste to make it work in your website.
  <br><br>
  https://refboost.com/customizer.php?id=".$sha1."
  <br><br>
  You can reply this email for any question or help,
<br><br>
  ----<br>
  The RefBoost Team<br><br>";

  //echo sha1($_POST['email']);

  require("widget/lib/class.phpmailer.php");
  include "widget/lib/class.smtp.php";
   
    $to = $_POST['email'];
    $subject = "Welcome to RefBoost";
    
    $mail = new PHPMailer();
    $mail->IsSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'mail.your-server.de';                 // Specify main and backup server
    
    $mail->Port = 587;                                    // Set the SMTP port
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'hello@refboost.com';
    $mail->Password = 'fC58Iky658aeJ2VZ';                  // SMTP password
    $mail->SMTPSecure = 'tsl';     
       $mail->SetFrom("hello@refboost.com");
   // $mail->AddCC("hello@natzar.co");
    $mail->IsHTML(true);
    $mail->CharSet = "UTF-8";
    $mail->AddAddress($to);
    $mail->Subject = $subject;
    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!";
    $mail->MsgHTML($body); 
    

    if ($mail->Send()):

     





?>

<div class="rounded-md bg-green-50 p-4">
  <div class="flex">
    <div class="flex-shrink-0">
      <!-- Heroicon name: mini/check-circle -->
      <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
      </svg>
    </div>
    <div class="ml-3">
      <h3 class="text-sm font-medium text-green-800">Sign up completed</h3>
      <div class="mt-2 text-sm text-green-700">
        <p>Please check your inbox to continue widget setup</p>
      </div>
      <div class="mt-4">
       
      </div>
    </div>
  </div>
</div>
<? else: ?>

<div class="rounded-md bg-green-50 p-4">
  <div class="flex">
    <div class="flex-shrink-0">
      <!-- Heroicon name: mini/check-circle -->
      <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
      </svg>
    </div>
    <div class="ml-3">
      <h3 class="text-sm font-medium text-green-800">Some error ocurred</h3>
      <div class="mt-2 text-sm text-green-700">
        <p>Please try again or contact us at hello@refboost.com</p>
      </div>
      <div class="mt-4">
       
      </div>
    </div>
  </div>
</div>

<?
endif;
endif;
    endif;
  ?>
  <main>

  	<div class="bg-white pt-10 sm:pt-16 lg:overflow-hidden lg:pb-14 lg:pt-8">
        <div class="mx-auto sm:max-w-7xl lg:px-8">
          <div class="lg:grid lg:grid-cols-2 lg:gap-8">
            <div class="mx-auto px-6 sm:max-w-2xl sm:text-center lg:flex lg:items-center lg:px-0 lg:text-left">
              <div class="lg:py-24">
                <a href="#" onclick="$('#modal_signup').fadeIn();" class="inline-flex items-center rounded-full bg-gray-100 p-1 pr-2 text-gray-400 hover:text-gray-700 sm:text-base lg:text-sm xl:text-base">
                  <span class="rounded-full bg-gradient-to-r from-gray-900 to-gray-900 px-3 py-0.5 text-sm font-semibold leading-5 text-white">We'll get you referrals</span>
                  <span class="ml-4 text-sm">Get Started</span>
                  <svg class="ml-2 h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                  </svg>
                </a>

                <h1 class="mt-4 text-5xl font-bold tracking-tight text-black sm:mt-5 sm:text-6xl lg:mt-6 xl:text-7xl">
                  <span class="block">Referrals Widget</span>
                  <span class="block bg-gradient-to-r from-purple-400 to-purple-800 bg-clip-text pb-3 text-transparent sm:pb-5">Simple Word of Mouth Boost</span>
                </h1>
                <p class="text-base text-gray-500 sm:text-xl lg:text-lg xl:text-xl">Easily gather referrals from your visitors and customers with this simple and customizable widget compatible with any kind of website, platform or CMS</p>


                <div class="mt-5">
                  <form action="#" class="sm:mx-auto sm:max-w-xl lg:mx-0">
                    <div class="min-w-0 flex-1">
                    	  <div class=" flex gap-x-4 w-full mx-auto text-center">
              <a href="#" onclick="$('#modal_signup').fadeIn();" class="inline-block rounded-lg bg-purple-600 px-4 py-1.5 text-base font-semibold leading-7 text-white shadow-sm ring-1 ring-purple-400 hover:bg-purple-700 hover:ring-purple-700">
               Get Started
                <span class="text-purple-200" aria-hidden="true">&rarr;</span>
              </a>
              <a href="#" onclick="refboost.init(); return false;" class="inline-block rounded-lg px-4 py-1.5 text-base font-semibold leading-7 text-gray-900 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
                Live demo
                <span class="text-gray-400" aria-hidden="true">&rarr;</span>
              </a>
            </div>
                     <!--  <div class="min-w-0 flex-1">
                        <label for="email" class="sr-only">Email address</label>
                        <input id="email" type="email" placeholder="Enter your email" class="block w-full rounded-md border-1 px-4 py-3 text-base text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:ring-offset-2 focus:ring-offset-gray-900">
                      </div>
                      <div class="mt-3 sm:ml-3 sm:mt-0">
                        <button type="submit" class="block w-full rounded-md bg-gradient-to-r from-purple-500 to-purple-600 px-4 py-3 font-medium text-white shadow hover:from-purple-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-offset-2 focus:ring-offset-gray-900">Get Started</button>
                      </div> -->
                    </div>
                    <p class="mt-3 text-xs text-gray-400 sm:mt-4">Receive installation instructions in your inbox. Use the widget for free, upgrade later to remove branding and extra features.</p>
                  </form>
                </div>
                <div class="mt-8 justify-start mx-auto text-left">

<div class="flex space-x-3 mt-4 justify-start mx-auto text-center">
	<p class="text-gray-400 text-xs">Enjoyable with:</p>
            <img width="40" height="auto" alt="Referrals widget wordpress" src="wordpress.png" style="height: 100%;">
                        <img width="35" alt="Referrals widget Shopify"  height="auto" src="shopify.png" style="height: 100%;">
                        <img width="40" alt="Referrals widget Prestashop" height="auto" src="prestashop.png" style="height: 100%;">
        </div>
    </div>

              </div>
            </div>
            <div class="-mb-16 mt-12 sm:-mb-48 lg:relative lg:m-0">
              <div class="mx-auto max-w-md px-6 sm:max-w-2xl lg:max-w-none lg:px-0">
                <!-- Illustration taken from Lucid Illustrations: https://lucid.pixsellz.io/ -->
               <img width="250" class="w-full lg:absolute lg:inset-y-0 lg:left-0 lg:h-full lg:w-auto lg:max-w-none" src="ilu0.png" >

                <!-- <img class="w-full lg:absolute lg:inset-y-0 lg:left-0 lg:h-full lg:w-auto lg:max-w-none" src="https://tailwindui.com/img/component-images/cloud-illustration-teal-cyan.svg" alt=""> -->
              </div>
            </div>
          </div>
        </div>
      </div>

   <a name="pricing"></a>
 <div class="lg:grid lg:grid-cols-2 max-w-6xl mx-auto">
            <div class="max-w-3xl text-center mx-auto mb-10">
 <div class="flow-root bg-white pt-10 pb-32 lg:pb-40">
    <div class="">
      <div class="relative z-10 mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto grid max-w-md grid-cols-1 gap-8 lg:max-w-4xl lg:grid-cols-2 lg:gap-8">
          <div class="flex flex-col rounded-3xl bg-white shadow-xl ring-1 ring-black/10">
            <div class="p-4">
              <h3 class="text-lg font-semibold leading-8 tracking-tight text-purple-600" id="tier-hobby">Free</h3>
              <div class="mt-4 flex justify-center items-baseline text-5xl font-bold tracking-tight text-gray-900">
                $0
                <span class="text-lg font-semibold leading-8 tracking-normal text-gray-500">/mo</span>
              </div>
              <!-- <p class="mt-6 text-base leading-7 text-gray-600">Try it for free, no credit card required</p> -->
            </div>
            <div class="flex flex-1 flex-col p-2">
              <div class="flex flex-1 flex-col justify-between rounded-2xl bg-gray-50 p-6 sm:p-8">
                <ul role="list" class="space-y-6">
                  <li class="flex items-start">
                    <div class="flex-shrink-0">
                      <!-- Heroicon name: outline/check -->
                      <svg class="h-6 w-6 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                      </svg>
                    </div>
                    <p class="ml-3 text-sm leading-6 text-gray-600">Unlimited referrals</p>
                  </li>

                  <li class="flex items-start">
                    <div class="flex-shrink-0">
                      <!-- Heroicon name: outline/check -->
                      <svg class="h-6 w-6 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                      </svg>
                    </div>
                    <p class="ml-3 text-sm leading-6 text-gray-600">Customize everything</p>
                  </li>

                 <!--  <li class="flex items-start">
                    <div class="flex-shrink-0">
                      
                      <svg class="h-6 w-6 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                      </svg>
                    </div>
                    <p class="ml-3 text-sm leading-6 text-gray-600">Vel ipsa esse repudiandae excepturi</p>
                  </li>

                  <li class="flex items-start">
                    <div class="flex-shrink-0">
                      
                      <svg class="h-6 w-6 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                      </svg>
                    </div>
                    <p class="ml-3 text-sm leading-6 text-gray-600">Itaque cupiditate adipisci quibusdam</p>
                  </li> -->
                </ul>
                <div class="mt-8">
                  <a href="javascript:$('#modal_signup').fadeIn();" class="inline-block w-full rounded-lg bg-purple-600 px-4 py-2.5 text-center text-sm font-semibold leading-5 text-white shadow-md hover:bg-purple-700" aria-describedby="tier-hobby">Get started</a>
                </div>
              </div>
            </div>
          </div>

          <div class="flex flex-col rounded-3xl bg-white shadow-xl ring-1 ring-black/10">
            <div class="p-4">
              <h3 class="text-lg font-semibold leading-8 tracking-tight text-purple-600" id="tier-team">Premium</h3>
              <div class="mt-4 flex justify-center  items-baseline text-5xl font-bold tracking-tight text-gray-900">
                $9
                <span class="text-lg font-semibold leading-8 tracking-normal text-gray-500">/mo</span>
              </div>
              <!-- <p class="mt-6 text-base leading-7 text-gray-600">Upgrade to premium for extra features and remove our branding</p> -->
            </div>
            <div class="flex flex-1 flex-col p-2">
              <div class="flex flex-1 flex-col justify-between rounded-2xl bg-gray-50 p-6 sm:p-8">
                <ul role="list" class="space-y-6">
                  <li class="flex items-start">
                    <div class="flex-shrink-0">
                      <!-- Heroicon name: outline/check -->
                      <svg class="h-6 w-6 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                      </svg>
                    </div>
                    <p class="ml-3 text-sm leading-6 text-gray-600">Unlimited referrals</p>
                  </li>

                  <li class="flex items-start">
                    <div class="flex-shrink-0">
                      <!-- Heroicon name: outline/check -->
                      <svg class="h-6 w-6 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                      </svg>
                    </div>
                    <p class="ml-3 text-sm leading-6 text-gray-600">Customize everything</p>
                  </li>

                  <li class="flex items-start">
                    <div class="flex-shrink-0">
                      <!-- Heroicon name: outline/check -->
                      <svg class="h-6 w-6 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                      </svg>
                    </div>
                    <p class="ml-3 text-sm leading-6 text-gray-600">Export captured leads</p>
                  </li>

                  <li class="flex items-start">
                    <div class="flex-shrink-0">
                      <!-- Heroicon name: outline/check -->
                      <svg class="h-6 w-6 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                      </svg>
                    </div>
                    <p class="ml-3 text-sm leading-6 text-gray-600">Send from your domain</p>
                  </li>

                  <li class="flex items-start">
                    <div class="flex-shrink-0">
                      <!-- Heroicon name: outline/check -->
                      <svg class="h-6 w-6 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                      </svg>
                    </div>
                    <p class="ml-3 text-sm leading-6 text-gray-600">Remove branding</p>
                  </li>
                </ul>
                <div class="mt-8">
                  <a href="https://buy.stripe.com/3cs3fNegF9597gA004" class="inline-block w-full rounded-lg bg-purple-600 px-4 py-2.5 text-center text-sm font-semibold leading-5 text-white shadow-md hover:bg-purple-700" aria-describedby="tier-team">Get Premium</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

</div>

</div>
<div>

              <section class="bg-white sm:pt-10  pb-20 px-6 sm:px-0">
  <figure class="mx-auto max-w-2xl">
    <p class="sr-only">5 out of 5 stars</p>
    <div class="flex gap-x-1 text-purple-600">
      <svg class="h-5 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
      </svg>
      <svg class="h-5 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
      </svg>
      <svg class="h-5 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
      </svg>
      <svg class="h-5 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
      </svg>
      <svg class="h-5 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
      </svg>
    </div>
    <blockquote class="mt-10 text-xl  font-semibold leading-8 tracking-tight text-gray-900 sm:text-2xl sm:leading-9">
      <p>“This simple referrals widget has completely transformed how we get new customers. Friends of friends only!”</p>
    </blockquote>
    <figcaption class="mt-10 flex items-center gap-x-6">
      <img class="h-12 w-12 rounded-full bg-gray-50" src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=1024&h=1024&q=80" alt="">
      <div class="text-sm leading-6">
        <div class="font-semibold text-gray-900">Marina Figueroa</div>
        <div class="mt-0.5 text-gray-600">CEO, Organic Basket Barcelona</div>
      </div>
    </figcaption>
  </figure>
</section>


            <!-- <div class="text-center text-xs mt-5">Try it, it's free!</div> -->
</div>

           



          </div>
          <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]">
          
          </div>
        </div>
      </div>
    </div>




    <!-- FAQ -->
    <a name="faq"></a>
    <div class=" ">
  <div class="mx-auto max-w-7xl  px-4  ">
    <div class="mx-auto max-w-3xl divide-y-2 divide-gray-200">
      <h2 class="text-center text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Frequently asked questions </h2>
      <dl class="mt-6 space-y-6 divide-y divide-gray-200">

<div class="pt-6">
          <dt class="text-lg">
       
            <button type="button" class="flex w-full items-start justify-between text-left text-gray-400" aria-controls="faq-0" aria-expanded="false">
              <span class="font-medium text-gray-900">How duplicated or fake emails are filtered?</span>
              <span class="ml-6 flex h-7 items-center">
             
                <svg class="rotate-0 h-6 w-6 transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
              </span>
            </button>
          </dt>
          <dd class="mt-2 pr-12" id="faq-0">
            <p class="text-base text-gray-500">
All emails are checked, in case one email is fake, process is interrupted. Fake emails are the ones that uses disposable emails, repeated emails, accounts in domains that doesn't exists or email inside the blocked domains database. Email format is checked, domain is checked, email from a free/one use emails are filtered. We use the same database as Hubspot to detect emails from suspicious domains.
</p>
          </dd>
        </div>


<!--   <div class="pt-6">
          <dt class="text-lg">
       
            <button type="button" class="flex w-full items-start justify-between text-left text-gray-400" aria-controls="faq-0" aria-expanded="false">
              <span class="font-medium text-gray-900">What are referrer, referee, rewards and some related terms?</span>
              <span class="ml-6 flex h-7 items-center">
             
                <svg class="rotate-0 h-6 w-6 transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
              </span>
            </button>
          </dt>
          <dd class="mt-2 pr-12" id="faq-0">
            <p class="text-base text-gray-500">



In our context of referral programs for business:
<br>
<strong>Referral:</strong> The act or process of transferring something to another, of sending by reference, or referring.<br>
<strong>Referrer (Brand Advocate/ Ambassador):</strong> a person who makes a referral/refers another (their friends, family and acquaintances).<br>
<strong>Referee (Friend):</strong> a person who is invited to a referral/ referred by another.<br>
<strong>Referral Programs:</strong> programs that are designed to specifically motivate the existing customers to help a business find new customers.<br>
<strong>Viral Loop:</strong> a mechanism that has users refer others to a product or service and then turns those referees into referrers through the same mechanism.<br>
<strong>Rewards:</strong> what participants in a referral program earn on successful completion of a referral.<br>
<strong>Happy moment:</strong> the time when a referrer is most likely to make a referral due to a recent happy experience while using your product or service.<br>
</p>
          </dd>
        </div> -->


        <div class="pt-6">
          <dt class="text-lg">
       
            <button type="button" class="flex w-full items-start justify-between text-left text-gray-400" aria-controls="faq-0" aria-expanded="false">
              <span class="font-medium text-gray-900">How does RefBoost work?</span>
              <span class="ml-6 flex h-7 items-center">
             
                <svg class="rotate-0 h-6 w-6 transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
              </span>
            </button>
          </dt>
          <dd class="mt-2 pr-12" id="faq-0">
            <p class="text-base text-gray-500">
RefBoost is a widget that you can add to your website or online store. When a visitor lands on your site, they will see a pop-up offering them a deal (you can define the deal) in exchange for sharing your product with their friends. When the emails are validated, an automatic email will be send to the customer that referred their friends.</p>
          </dd>
        </div>


            <div class="pt-6">
          <dt class="text-lg">
       
            <button type="button" class="flex w-full items-start justify-between text-left text-gray-400" aria-controls="faq-0" aria-expanded="false">
              <span class="font-medium text-gray-900">

How do I install RefBoost on my website?</span>
              <span class="ml-6 flex h-7 items-center">
             
                <svg class="rotate-0 h-6 w-6 transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
              </span>
            </button>
          </dt>
          <dd class="mt-2 pr-12" id="faq-0">
            <p class="text-base text-gray-500">

Installing RefBoost on your website is easy. Simply copy and paste a single line of code into the HTML of your website or online store. You can then customize the widget from your private dashboard, including the layout, notification emails, and minimum number of friends required to unlock the deal.
</p>
          </dd>
        </div>




            <div class="pt-6">
          <dt class="text-lg">
       
            <button type="button" class="flex w-full items-start justify-between text-left text-gray-400" aria-controls="faq-0" aria-expanded="false">
              <span class="font-medium text-gray-900">Can I customize the deal offered by RefBoost?</span>
              <span class="ml-6 flex h-7 items-center">
             
                <svg class="rotate-0 h-6 w-6 transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
              </span>
            </button>
          </dt>
          <dd class="mt-2 pr-12" id="faq-0">
            <p class="text-base text-gray-500">


Yes, you can craft and email to be sent to friends and to the main referral from your private dashboard. You can include a coupon in the emails, or whatever you can think of. There is an email sent to the main contact and another one that will be sent to the referred friends.</p>
          </dd>
        </div>


            <div class="pt-6">
          <dt class="text-lg">
       
            <button type="button" class="flex w-full items-start justify-between text-left text-gray-400" aria-controls="faq-0" aria-expanded="false">
              <span class="font-medium text-gray-900">Is RefBoost compatible with all websites and online stores?</span>
              <span class="ml-6 flex h-7 items-center">
             
                <svg class="rotate-0 h-6 w-6 transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
              </span>
            </button>
          </dt>
          <dd class="mt-2 pr-12" id="faq-0">
            <p class="text-base text-gray-500">RefBoost is designed to be compatible with any platform or website where you can include an external javascript file. However, if you encounter any issues with installation or compatibility, you can contact the RefBoost support team for assistance at hello@refboost.com
</p>
          </dd>
        </div>


       <div class="pt-6">
          <dt class="text-lg">
       
            <button type="button" class="flex w-full items-start justify-between text-left text-gray-400" aria-controls="faq-0" aria-expanded="false">
              <span class="font-medium text-gray-900">How will RefBoost increase traffic and sales for my business?</span>
              <span class="ml-6 flex h-7 items-center">
             
                <svg class="rotate-0 h-6 w-6 transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
              </span>
            </button>
          </dt>
          <dd class="mt-2 pr-12" id="faq-0">
            <p class="text-base text-gray-500">For example, by offering a discount coupon in exchange for sharing your product with friends, RefBoost incentivizes visitors to share your product via email. This can help to increase traffic to your website or online store, as well as drive sales by attracting new customers. You can use the emails to define what type of deal they will get.
</p>
          </dd>
        </div>



   <div class="pt-6">
          <dt class="text-lg">
       
            <button type="button" class="flex w-full items-start justify-between text-left text-gray-400" aria-controls="faq-0" aria-expanded="false">
              <span class="font-medium text-gray-900">
Is RefBoost free to use?
</span>
              <span class="ml-6 flex h-7 items-center">
             
                <svg class="rotate-0 h-6 w-6 transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
              </span>
            </button>
          </dt>
          <dd class="mt-2 pr-12" id="faq-0">
            <p class="text-base text-gray-500">
Yes you can include it to your website for free. The free version include our branding.
</p>
          </dd>
        </div>

<!-- Can I track the performance of RefBoost on my website or online store?
Yes, RefBoost provides detailed analytics and tracking tools to help you monitor the performance of the widget on your website or online store. You can view metrics such as the number of coupons redeemed, the number of shares generated, and the resulting increase in traffic and sales.
 -->
   <div class="pt-6">
          <dt class="text-lg">
       
            <button type="button" class="flex w-full items-start justify-between text-left text-gray-400" aria-controls="faq-0" aria-expanded="false">
              <span class="font-medium text-gray-900">Is RefBoost compatible with mobile devices?</span>
              <span class="ml-6 flex h-7 items-center">
             
                <svg class="rotate-0 h-6 w-6 transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
              </span>
            </button>
          </dt>
          <dd class="mt-2 pr-12" id="faq-0">
            <p class="text-base text-gray-500">
Yes, RefBoost is designed to be fully responsive and compatible with mobile devices, including smartphones and tablets. You can enable or disable it for mobile devices from your private area.
</p>
          </dd>
        </div>


<div class="pt-6">
          <dt class="text-lg">
       
            <button type="button" class="flex w-full items-start justify-between text-left text-gray-400" aria-controls="faq-0" aria-expanded="false">
              <span class="font-medium text-gray-900">Can I customize the look and feel of RefBoost on my website?</span>
              <span class="ml-6 flex h-7 items-center">
             
                <svg class="rotate-0 h-6 w-6 transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
              </span>
            </button>
          </dt>
          <dd class="mt-2 pr-12" id="faq-0">
            <p class="text-base text-gray-500">
Yes, you can customize the appearance of RefBoost from your private dashboard, including the layout, colors, and fonts. You can customize also the emails that will be sent.
</p>
          </dd>
        </div>


<div class="pt-6">
          <dt class="text-lg">
       
            <button type="button" class="flex w-full items-start justify-between text-left text-gray-400" aria-controls="faq-0" aria-expanded="false">
              <span class="font-medium text-gray-900">Is RefBoost GDPR compliant?</span>
              <span class="ml-6 flex h-7 items-center">
             
                <svg class="rotate-0 h-6 w-6 transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
              </span>
            </button>
          </dt>
          <dd class="mt-2 pr-12" id="faq-0">
            <p class="text-base text-gray-500">
RefBoost is designed to be GDPR compliant, meaning that it adheres to all relevant privacy laws and regulations. You can review the RefBoost privacy policy for more information.
</p>
          </dd>
        </div>



        <!-- More questions... -->
      </dl>
    </div>
  </div>
</div>
<!-- This example requires Tailwind CSS v3.0+ -->


  </main>
</div>
<!-- MODAL LOGIN/SIGNUP/RECOVER -->

<div id="modal_signup" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <!--
    Background backdrop, show/hide based on modal state.

    Entering: "ease-out duration-300"
      From: "opacity-0"
      To: "opacity-100"
    Leaving: "ease-in duration-200"
      From: "opacity-100"
      To: "opacity-0"
  -->
  <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

  <div class="fixed inset-0 z-10 overflow-y-auto">
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
      <!--
        Modal panel, show/hide based on modal state.

        Entering: "ease-out duration-300"
          From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          To: "opacity-100 translate-y-0 sm:scale-100"
        Leaving: "ease-in duration-200"
          From: "opacity-100 translate-y-0 sm:scale-100"
          To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
      -->
      <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
         <div class="absolute top-0 right-0 hidden pt-4 pr-4 sm:block">
          <button onclick="$('#modal_signup').fadeOut();" type="button" class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
            <span class="sr-only">Close</span>
            <!-- Heroicon name: outline/x-mark -->
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <div>
          <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full ">
            <!-- Heroicon name: outline/check -->
              <img class="mx-auto h-12 w-auto" src="refboost-logo.png" alt="RefBoost Logo">
          </div>
          <div class="mt-3 text-center sm:mt-5">
            <h3 class="text-lg font-bold leading-6 text-gray-900" id="modal-title">Get Started</h3>
            <p class="text-sm text-gray-700">You will receive an email with instructions to access your dashboard</p><div class="mt-2">
              

            <form id="friendly_discount_signup_form" class="space-y-6 text-left justify-start" action="" method="post">
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
          <div class="mt-1 hidden">
            <input id="name" name="name" placeholder="name" type="text" autocomplete="no" value=""  class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-purple-500 focus:outline-none focus:ring-purple-500 sm:text-sm">
          </div>
          <div class="mt-1">
            <input id="email" name="email" placeholder="email@domain.com" type="email" autocomplete="email" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-purple-500 focus:outline-none focus:ring-purple-500 sm:text-sm">
          </div>
        </div>

       <!--  <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Website URL</label>
          <div class="mt-1">
            <input id="url" name="url" type="url" autocomplete="current-password" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-purple-500 focus:outline-none focus:ring-purple-500 sm:text-sm">
          </div>
        </div> -->

        <!-- <div class="flex items-center justify-between">
           <div class="flex items-center">
            <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-purple-600 focus:ring-purple-500">
            <label for="remember-me" class="ml-2 block text-sm text-gray-900">Remember me</label>
          </div>

          <div class="text-sm">
            <a href="#" class="font-medium text-purple-600 hover:text-purple-500">Forgot your password?</a>
          </div> 
            <p class="text-sm text-gray-500">Follow the instructions you will receive in your email inbox.</p>
        </div> -->

        <div>
          <button id="friendly_discount_signup_form_submit_button" type="submit" name="submit" class="flex w-full justify-center rounded-md border border-transparent bg-purple-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">GET IT</button>
        </div>
        <p class="text-xs text-gray-400">Your email will be stored in our database, it will not be shared with anyone, it will serve just as a way to login in your account</p>
      </form>
            </div>
          </div>
        </div>
      <!--   <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
          <button type="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-purple-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 sm:col-start-2 sm:text-sm">Deactivate</button>
          <button onclick="$('#modal_signup').fadeOut()" type="button" class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 sm:col-start-1 sm:mt-0 sm:text-sm">Cancel</button>
        </div> -->
      </div>
    </div>
  </div>
</div>



<!-- FOOTER -->
<footer class="bg-white">
  <div class="mx-auto max-w-7xl py-12 px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
    <div class="flex justify-center space-x-6 md:order-2">
      <!-- <a href="#" class="text-gray-400 hover:text-gray-500">
        <span class="sr-only">Facebook</span>
        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
          <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
        </svg>
      </a>

      <a href="#" class="text-gray-400 hover:text-gray-500">
        <span class="sr-only">Instagram</span>
        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
          <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
        </svg>
      </a>
 -->
     

    </div>
    <div class="mt-8 md:order-1 md:mt-0">
      <p class="text-center text-xs text-gray-400">RefBoost &copy; 2022 Ayesa Digital SL, All rights reserved · Made by <a class="underine text-purple-600" href="https://x.com/betoayesa" target="_blank">@betoayesa</a>   <!-- <a href="#" class="text-gray-400 hover:text-gray-500">
        <span class="sr-only">Twitter</span>
        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
          <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
        </svg>
      </a> --></p>
    </div>
  </div>
</footer>

<script src="https://refboost.com/widget/?id=442f408e724765233071c8a847c1ced506227a9e"></script>
</body>
</html>