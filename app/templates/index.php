<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Counterify | Make it count</title>
		<meta name="title" content="Counterify | Make it count">
	    <meta name="author" content="Php Ninja">
		<meta name="description" content=" This tool allows you to count everything effortlessly via API and mobile Web App">
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


<!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Counterify">
    <meta property="og:description" content="This tool allows you to count everything effortlessly via API and mobile Web App">
    <meta property="og:image" content="https://www.counterify.com/graph-counterify.png">
    <meta property="og:image:width" content="1280">
    <meta property="og:image:height" content="640">
    <meta property="og:url" content="https://www.counterify.com">
    <meta property="og:type" content="website">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Modify assets/ files -->    
    <link rel="stylesheet" type="text/css" href="assets/css/custom.css">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <style>
	code{ font-family:'Courier New',Courier, serif;}
	</style>


<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@900;1000&display=swap" rel="stylesheet">

    <style>
      h1,h2,h3,.nunito {
       font-family: 'Nunito', sans-serif;

      }
      p{font-family:'Courier New',serif;}
    </style>
    
  </head>
  <body class="">
  	<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-7PND9VPM5D"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-7PND9VPM5D');
</script>


	<? include "header.php"; ?>
	  <div class="bg-white">
  

  <div class="relative isolate px-6  lg:px-8">
   
    <div class="mx-auto max-w-7xl py-16 sm:py-48 lg:py-16">
<!--
      <div class="hidden sm:mb-8 sm:flex sm:justify-center">
        <div class="relative rounded-full py-1 px-3 text-sm leading-6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
          Announcing our next round of funding. <a href="#" class="font-semibold text-indigo-600"><span class="absolute inset-0" aria-hidden="true"></span>Read more <span aria-hidden="true">&rarr;</span></a>
        </div>
      </div>
-->
      <div class="text-center">
	      <div class="hidden sm:mb-8 sm:flex sm:justify-center">
        <p class="block relative rounded-full py-1 px-3 text-sm leading-6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
         BETA Released: Your feedback is gold <a target="_blank" href="https://www.twitter.com/betoayesa" rel="nofollow" class="font-semibold text-indigo-600"><span class="absolute inset-0" aria-hidden="true"></span>@betoayesa <span aria-hidden="true">&rarr;</span></a>
        </p>
      </div>
        <h1 class="font-bold tracking-tight text-gray-900 text-5xl md:text-8xl  ">Make it count</h1>
        <p class="mt-6 max-w-3xl mx-auto text-md leading-6 text-gray-600">Collect data everyday and measure various activities to make data-driven decisions for personal and business success</p>



        <div class="mt-10 flex items-center justify-center gap-x-6">
         
          <a href="https://app.counterify.com/signup" type="button" class="rounded-full shadow-md inline-flex bg-indigo-600 py-4 px-6 text-lg font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create counter <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-mr-0.5 ml-2 h-7 w-7">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 15l3-3m0 0l-3-3m3 3h-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
</svg>

</a>
    

        </div>
         <p class="text-xs text-gray-600 mt-4 block">No credit card required, signup for free</p>
         <dl id="counters" class="mt-16 grid grid-cols-2 gap-0.5 overflow-hidden rounded-2xl text-center sm:grid-cols-2 lg:grid-cols-4 shadow-md">
        <div class="flex flex-col bg-gray-400/5 p-8">
          <dt class="text-sm font-semibold leading-6 text-gray-600">MRR</dt>
          <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">9600</dd>
        </div>

        <div class="flex flex-col bg-gray-400/5 p-8">
          <dt class="text-sm font-semibold leading-6 text-gray-600">Customers</dt>
          <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">256</dd>
        </div>

        <div class="flex flex-col bg-gray-400/5 p-8">
          <dt class="text-sm font-semibold leading-6 text-gray-600">New Customers</dt>
          <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">37</dd>
        </div>

        <div class="flex flex-col bg-gray-400/5 p-8">
          <dt class="text-sm font-semibold leading-6 text-gray-600">New Leads</dt>
          <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">112</dd>
        </div>
        
         <div class="flex flex-col bg-gray-400/5 p-8">
          <dt class="text-sm font-semibold leading-6 text-gray-600">Calls received</dt>
          <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">19</dd>
        </div>

        <div class="flex flex-col bg-gray-400/5 p-8">
          <dt class="text-sm font-semibold leading-6 text-gray-600">Forms submitted</dt>
          <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">51</dd>
        </div>

        <div class="flex flex-col bg-gray-400/5 p-8">
          <dt class="text-sm font-semibold leading-6 text-gray-600">Unique visits</dt>
          <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">512</dd>
        </div>

        <div class="flex flex-col bg-gray-400/5 p-8">
          <dt class="text-sm font-semibold leading-6 text-gray-600">Page views</dt>
          <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">5600</dd>
        </div>
        
         <div class="flex flex-col bg-gray-400/5 p-8">
          <dt class="text-sm font-semibold leading-6 text-gray-600">SEO visitors</dt>
          <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">2330</dd>
        </div>

        <div class="flex flex-col bg-gray-400/5 p-8">
          <dt class="text-sm font-semibold leading-6 text-gray-600">SEM visitors</dt>
          <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">1900</dd>
        </div>

        <div class="flex flex-col bg-gray-400/5 p-8">
          <dt class="text-sm font-semibold leading-6 text-gray-600">E-mail marketing visitors</dt>
          <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">654</dd>
        </div>

        <div class="flex flex-col bg-gray-400/5 p-8">
          <dt class="text-sm font-semibold leading-6 text-gray-600">Direct visitors</dt>
          <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">413</dd>
        </div>
         <div class="flex flex-col bg-gray-400/5 p-8">
          <dt class="text-sm font-semibold leading-6 text-gray-600">SEO Leads</dt>
          <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">8000</dd>
        </div>

        <div class="flex flex-col bg-gray-400/5 p-8">
          <dt class="text-sm font-semibold leading-6 text-gray-600">SEM Leads</dt>
          <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">3</dd>
        </div>

        <div class="flex flex-col bg-gray-400/5 p-8">
          <dt class="text-sm font-semibold leading-6 text-gray-600">E-mail marketing leads</dt>
          <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">99</dd>
        </div>

        <div class="flex flex-col bg-gray-400/5 p-8">
          <dt class="text-sm font-semibold leading-6 text-gray-600">Direct Leads</dt>
          <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">70</dd>
        </div>
        </dl>
      </div>
    </div>
     </div>
</div>
<div class="mx-auto max-w-7xl text-center">
        <a href="https://app.counterify.com/signup" type="button" class="rounded-full shadow-md inline-flex bg-indigo-600 py-4 px-6 text-lg font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create counter <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-mr-0.5 ml-2 h-7 w-7">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 15l3-3m0 0l-3-3m3 3h-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
</svg>

</a>
<p class="text-xs text-gray-600 mt-4">No credit card required, signup for free</p>
</div>

<!-- -->
<a name="features"></a>



<div class="overflow-hidden bg-white py-24 sm:py-32">
  <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-2">
      <div class="lg:pr-8 lg:pt-4">
        <div class="lg:max-w-lg">
          <h2 class="text-base font-semibold leading-7 text-indigo-600">Data-driven decisions</h2>
          <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Measure everything</p>
          <p class="mt-6 text-lg leading-6 text-gray-600">Gathering data, enables you to optimize processes, enhance user experiences, and drive growth.</p>
          <dl class="mt-10 max-w-xl space-y-8 text-base leading-7 text-gray-600 lg:max-w-none">
            <div class="relative pl-9">
              <dt class="inline font-semibold text-gray-900">
                <svg class="absolute left-1 top-1 h-5 w-5 text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M5.5 17a4.5 4.5 0 01-1.44-8.765 4.5 4.5 0 018.302-3.046 3.5 3.5 0 014.504 4.272A4 4 0 0115 17H5.5zm3.75-2.75a.75.75 0 001.5 0V9.66l1.95 2.1a.75.75 0 101.1-1.02l-3.25-3.5a.75.75 0 00-1.1 0l-3.25 3.5a.75.75 0 101.1 1.02l1.95-2.1v4.59z" clip-rule="evenodd" />
                </svg>
               Collect data
              </dt>
              <dd class="inline">Start pushing data, via API or manually via the mobile web app. With our powerful data collection capabilities, you can rest assured that you're getting accurate and reliable data in real time.</dd>
            </div>
           
            <div class="relative pl-9">
              <dt class="inline font-semibold text-gray-900">
                <svg class="absolute left-1 top-1 h-5 w-5 text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path d="M4.632 3.533A2 2 0 016.577 2h6.846a2 2 0 011.945 1.533l1.976 8.234A3.489 3.489 0 0016 11.5H4c-.476 0-.93.095-1.344.267l1.976-8.234z" />
                  <path fill-rule="evenodd" d="M4 13a2 2 0 100 4h12a2 2 0 100-4H4zm11.24 2a.75.75 0 01.75-.75H16a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75h-.01a.75.75 0 01-.75-.75V15zm-2.25-.75a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75H13a.75.75 0 00.75-.75V15a.75.75 0 00-.75-.75h-.01z" clip-rule="evenodd" />
                </svg>
                Visualize & Export
              </dt>
              <dd class="inline">It's easy to explore your data, you can quickly get a clear picture of your data and make informed decisions based on the insights you uncover. You can just export it too.</dd>
            </div>
          </dl>
        </div>
      </div>
      <img src="counterify-screenshot.png" alt="Product screenshot" class="w-[48rem] max-w-none rounded-xl shadow-xl ring-1 ring-gray-400/10 sm:w-[57rem] md:-ml-4 lg:-ml-0" width="2432" height="1442">
    </div>
  </div>
</div>





<div class="overflow-hidden bg-white py-24 sm:py-32">
  <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-2">
      <div class="lg:ml-auto lg:pl-4 lg:pt-4">
        <div class="lg:max-w-lg">
          <h2 class="text-base font-semibold leading-7 text-indigo-600">Automatic / Manual</h2>
          <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">API & Mobile Web App</p>
          <p class="mt-6 text-lg leading-6 text-gray-600">As the saying goes, "You cannot improve what you cannot measure." </p>
          <dl class="mt-10 max-w-xl space-y-8 text-base leading-7 text-gray-600 lg:max-w-none">
            <div class="relative pl-9">
              <dt class="inline font-semibold text-gray-900">
                <svg class="absolute left-1 top-1 h-5 w-5 text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M5.5 17a4.5 4.5 0 01-1.44-8.765 4.5 4.5 0 018.302-3.046 3.5 3.5 0 014.504 4.272A4 4 0 0115 17H5.5zm3.75-2.75a.75.75 0 001.5 0V9.66l1.95 2.1a.75.75 0 101.1-1.02l-3.25-3.5a.75.75 0 00-1.1 0l-3.25 3.5a.75.75 0 101.1 1.02l1.95-2.1v4.59z" clip-rule="evenodd" />
                </svg>
               API
              </dt>
              <dd class="inline">Use Counterify's API to collect data directly. Create counters on-the-fly</dd>
            </div>
            <div class="relative pl-9">
              <dt class="inline font-semibold text-gray-900">
                <svg class="absolute left-1 top-1 h-5 w-5 text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
                </svg>
                Mobile 
              </dt>
              <dd class="inline">Data can come from any real life situation or scenario. </dd>
            </div>
            <div class="relative pl-9">
              <dt class="inline font-semibold text-gray-900">
                <svg class="absolute left-1 top-1 h-5 w-5 text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path d="M4.632 3.533A2 2 0 016.577 2h6.846a2 2 0 011.945 1.533l1.976 8.234A3.489 3.489 0 0016 11.5H4c-.476 0-.93.095-1.344.267l1.976-8.234z" />
                  <path fill-rule="evenodd" d="M4 13a2 2 0 100 4h12a2 2 0 100-4H4zm11.24 2a.75.75 0 01.75-.75H16a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75h-.01a.75.75 0 01-.75-.75V15zm-2.25-.75a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75H13a.75.75 0 00.75-.75V15a.75.75 0 00-.75-.75h-.01z" clip-rule="evenodd" />
                </svg>
                Not a boring dashboard

              </dt>
              <dd class="inline">By pressing in any counter you can +1 at any moment. From a desktop you can view logs, charts and visualize data by period.</dd>
            </div>
          </dl>
        </div>
      </div>
      <div class="flex items-start justify-end lg:order-first">
        <img src="counterify-mobile-screenshot.png" alt="Product screenshot" class=" max-w-none rounded-xl shadow-xl ring-1 ring-gray-400/10 " >
      </div>
    </div>
  </div>
</div>







       <a name="cases"></a> 
<div class="container mx-auto p-4 mt-8">

  
<div class="mx-auto max-w-xl text-center mb-5">
      <h2 class="text-lg font-semibold leading-8 tracking-tight text-indigo-600">Ultra Flexible</h2>
      <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Use Cases & Ideas</p>

      <p>Counterify allows you to collect and show the data accumulated by period. You have to see the dashboard.</p>
    </div>
 
 <div class="grid grid-cols-1 md:grid-cols-3 gap-4">



  <div class="bg-white p-6 rounded-lg shadow-lg">
  
    <h3 class="text-xl font-bold mt-4">Conversion Optimization Made Simple</h3>
    <p class="mt-2">Enhance your website's performance with conversion optimization. Utilize Counterify's data collection to perform A/B testing on elements and track user interactions effortlessly.</p>
  </div>

  <div class="bg-white p-6 rounded-lg shadow-lg">
    <h3 class="text-xl font-bold mt-4">Low-Level Operations Tracking for Businesses</h3>
    <p class="mt-2">Take control of your business operations with low-level tracking. Monitor call details, support interactions, and customer complaints to improve overall efficiency.</p>
  </div>

  <div class="bg-white p-6 rounded-lg shadow-lg">
    
    <h3 class="text-xl font-bold mt-4">Website Traffic Analytics</h3>
    <p class="mt-2">Measure your website's success with detailed analytics. Track visits, pageviews, and traffic sources to understand user behavior and refine your online presence.</p>
  </div>

  <div class="bg-white p-6 rounded-lg shadow-lg">
    
    <h3 class="text-xl font-bold mt-4">Visualize Your Funnel</h3>
    <p class="mt-2">Gain insights into your conversion funnel. Quantify the flow of visitors to leads, customers, and repeat customers, enabling you to optimize your business strategy.</p>
  </div>

  <div class="bg-white p-6 rounded-lg shadow-lg">
    
    <h3 class="text-xl font-bold mt-4">Monitoring the headcount in a facility</h3>
    <p class="mt-2">The typical gadget digitalized, in real time, shared and logged.</p>
  </div>

  <div class="bg-white p-6 rounded-lg shadow-lg">
    
    <h3 class="text-xl font-bold mt-4">Real-time KPIs</h3>
    <p class="mt-2">Build you own KPI dashboard and maintain it nurtured in real time.</p>
  </div>

  <div class="bg-white p-6 rounded-lg shadow-lg">
    
    <h3 class="text-xl font-bold mt-4">Marketing Funnel Visualization and Control</h3>
    <p class="mt-2">[Insert description here]</p>
  </div>

  <div class="bg-white p-6 rounded-lg shadow-lg">
    
    <h3 class="text-xl font-bold mt-4">SaaS Metrics</h3>
    <p class="mt-2">[Insert description here]</p>
  </div>

  <div class="bg-white p-6 rounded-lg shadow-lg">
    
    <h3 class="text-xl font-bold mt-4">Habits Tracking</h3>
    <p class="mt-2">[Insert description here]</p>
  </div>

  

</div>



</div>





<!-- pricing -->
<a name="pricing"></a>
    


<div class="isolate overflow-hidden bg-gray-900 mt-10">
  <div class="mx-auto max-w-7xl px-6 pb-96 pt-24 text-center sm:pt-32 lg:px-8">
    <div class="mx-auto max-w-4xl">
      <h2 class="text-base font-semibold leading-7 text-indigo-400">Pricing</h2>
      <h3 class="mt-2 text-4xl font-bold tracking-tight text-white sm:text-5xl">Start measuring, start improving</h3>
    </div>
    <div class="relative mt-6">
      <p class="mx-auto max-w-2xl text-lg leading-8 text-white/60">Get 1 month free with the yearly subscription </p>
      <svg viewBox="0 0 1208 1024" class="absolute -top-10 left-1/2 -z-10 h-[64rem] -translate-x-1/2 [mask-image:radial-gradient(closest-side,white,transparent)] sm:-top-12 md:-top-20 lg:-top-12 xl:top-0">
        <ellipse cx="604" cy="512" fill="url(#6d1bd035-0dd1-437e-93fa-59d316231eb0)" rx="604" ry="512" />
        <defs>
          <radialGradient id="6d1bd035-0dd1-437e-93fa-59d316231eb0">
            <stop stop-color="#7775D6" />
            <stop offset="1" stop-color="#E935C1" />
          </radialGradient>
        </defs>
      </svg>
    </div>
  </div>
  <div class="flow-root bg-white pb-24 sm:pb-32">
    <div class="-mt-80">
      <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto grid  grid-cols-1 gap-8  lg:grid-cols-3">
        	 <div class="flex flex-col justify-between rounded-3xl bg-white p-8 shadow-xl ring-1 ring-gray-900/10 sm:p-10">
      <div>
        <h3 id="tier-free" class="text-base font-semibold leading-7 text-indigo-600">Free</h3>
        <div class="mt-4 flex items-baseline gap-x-2">
          <span class="text-5xl font-bold tracking-tight text-gray-900">FREE</span>
        </div>
        <p class="mt-6 text-base leading-7 text-gray-600">Start with our free tier to get started!</p>
        <ul role="list" class="mt-10 space-y-4 text-sm leading-6 text-gray-600">
          <li class="flex gap-x-3">
            <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd"></path>
            </svg>
            Basic features included
          </li>
          <li class="flex gap-x-3">
            <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd"></path>
            </svg>
            Limited data storage
          </li>
          <li class="flex gap-x-3">
            <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd"></path>
            </svg>
            Community support
          </li>
        </ul>
      </div>
      <a href="https://app.counterify.com/signup" aria-describedby="tier-free" class="mt-8 block rounded-md bg-indigo-600 px-3.5 py-2 text-center text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Get started for free</a>
    </div>

          <div class="flex flex-col justify-between rounded-3xl bg-white p-8 shadow-xl ring-1 ring-gray-900/10 sm:p-10">
            <div>
              <h3 id="tier-hobby" class="text-base font-semibold leading-7 text-indigo-600">Month</h3>
              <div class="mt-4 flex items-baseline gap-x-2">
                <span class="text-5xl font-bold tracking-tight text-gray-900">$7</span>
                <span class="text-base font-semibold leading-7 text-gray-600">/month</span>
              </div>
              <p class="mt-6 text-base leading-7 text-gray-600">Start taking data-driven decisions inmediately</p>
              <ul role="list" class="mt-10 space-y-4 text-sm leading-6 text-gray-600">
                <li class="flex gap-x-3">
                  <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                  </svg>
                  Unlimited counters & groups
                </li>
                <li class="flex gap-x-3">
                  <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                  </svg>
                  API access
                </li>
                <li class="flex gap-x-3">
                  <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                  </svg>
                  Mobile web app
                </li>
              
              </ul>
            </div>
            <a href="https://buy.stripe.com/14k4h4aNO6IMd8c8wx" aria-describedby="tier-hobby" class="mt-8 block rounded-md bg-indigo-600 px-3.5 py-2 text-center text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Get started today</a>
          </div>
          <div class="flex flex-col justify-between rounded-3xl bg-white p-8 shadow-xl ring-1 ring-gray-900/10 sm:p-10">
            <div>
              <h3 id="tier-team" class="text-base font-semibold leading-7 text-indigo-600">Year</h3>
              <div class="mt-4 flex items-baseline gap-x-2">
                <span class="text-5xl font-bold tracking-tight text-gray-900">$77</span>
                <span class="text-base font-semibold leading-7 text-gray-600">/year</span>
              </div>
              <p class="mt-6 text-base leading-7 text-gray-600">Get 1 month free with yearly subscription</p>
              <ul role="list" class="mt-10 space-y-4 text-sm leading-6 text-gray-600">
               
                <li class="flex gap-x-3">
                  <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                  </svg>
                  Unlimited counters & groups
                </li>
                <li class="flex gap-x-3">
                  <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                  </svg>
                  API access
                </li>
                <li class="flex gap-x-3">
                  <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                  </svg>
                  Mobile web app
                </li>
                
                <li class="flex gap-x-3">
                  <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                  </svg>
                  Get 1 month free
                </li>
              </ul>
            </div>
            <a href="https://buy.stripe.com/28o28Wf44c36d8ccMM" aria-describedby="tier-team" class="mt-8 block rounded-md bg-indigo-600 px-3.5 py-2 text-center text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Get started today</a>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<a name="api"></a>


<div class="bg-white px-6 pb-20 lg:px-8">
  <div class="mx-auto max-w-7xl text-base leading-7 text-gray-700">
    <p class="text-base font-semibold leading-7 text-indigo-600">Documentation</p>
    <h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">API</h1>
    
    
    <div class="grid grid-cols-2 gap-8">
    	<div>


<p class="mt-5 leading-6">To push data to counters via API, businesses can use any programming language that supports HTTP requests, such as PHP or JavaScript. For example, a PHP script could be used to send data from a form on a website directly to a counter via an API call. Similarly, a JavaScript function could be used to send data from a web application to a counter, allowing real-time tracking of user behavior.</p>

    <code class="bg-gray-50 border-gray-200 border px-3 py-3 block text-sm rounded-md mt-5">
    
    <strong>API Main Endpoint:</strong><br>
     https://api.counterify.com<br><br>
     <strong>Authentication</strong><br>
     Header Authorization: beaarer [your token]<br>
     'bearer' POST field<br>
     'bearer' GET field as a url parameter ?bearer=<br>

     <br>
     <strong>Most important request</strong><br>
      If you push to a counter that doesn't exist, it will be created on the fly. You can select counter by id or by label.
<br><br>
    POST https://api.counterify.com/ (params)<br><br>

    params := {
      label: 'Counter label or name',
      count: 1,
      bearear: 'YOUR TOKEN HERE'
    };

    
</code>
<p>counter[label].count += params.count</p>

   

<h3 class="mt-10 text-lg font-bold tracking-tight text-gray-900">cURL example</h3>
	<code class="bg-gray-50 border-gray-200 border px-3 py-3 block text-sm rounded-md"><pre>curl -X POST 
  -H "Authorization: Bearer Your Token here" 
  -H "Content-Type: application/json" 
  -d '{"label": "Counter label or name", "count": "1"}' 
  https://api.counterify.com
	</pre></code>
    
    



    </div>

<div class="leading-6">
<h3 class="mt-10 text-lg font-bold tracking-tight text-gray-900">WordPress Contact Forms</h3>

<p>Use the plugin named "3rd party" for contact forms, you will be able to map form fields to counters.
<br>
Submission url: https://api.counterify.com
<br>
Map the fields to label, count and set the bearear as value.</p>



<h3 class="mt-10 text-lg font-bold tracking-tight text-gray-900">Have you met the good old ping attribute?</h3>

<p>The <strong>PING attribute:</strong> when any html element with an attribute ping is clicked, the browser sends a request to the url specified in the ping attr. Good to count clicks.</p>

    <code class="bg-gray-50 border-gray-200 border px-3 py-3 block text-xs rounded-md">
<pre>
&lt;a href="#whatever" 
class="button" 
ping="https://api.counterify.com/?label=button-clicked&(...)"&gt;
Button Label&lt;/a&gt;


</pre>
Line too big, just an example but you get the idea that you can make a request using the url and parameters set in ping attribute


    </code>
    
   <h3 class="mt-10 text-lg font-bold tracking-tight text-gray-900">Javascript</h3>

    <p>Web Analytics, A/B testing, CRO ... counting events with Js opens a world of posibilities. Ideally you don't want to make your token public, you should send the request to your backend, and the backend makes the request to counterify.com.</p>

    <code class="bg-gray-50 border-gray-200 border px-3 py-3 block text-xs rounded-md mt-5"><pre>
&lt;!-- Counting events via JS + API --&gt;
&lt;script&gt;
  function counterify(param, value) {
    if (param) {
      var params = {
        label: param,
        count: value,        
      };

      fetch('https://api.counterify.com/counter', {
        method: 'POST',
        headers: {
          'Authorization': `Bearer [YOUR TOKEN HERE]`,
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(params)
      }).then(response => {
        console.log('Event counted successfully');
      }).catch(error => {
        console.error('Error counting event:', error);
      });
    }
  }

  function jquery_counterify(param, value) {
  if (param) {
    var params = {
      label: param,
      count: value,
      bearear: 'YOUR TOKEN HERE'
    };

    $.post('https://api.counterify.com/', params, function(data) {
      console.log(data);
    });
  }
  }

&lt;/script&gt;
    </pre></code>

   





	
	



<h3 class="mt-10 text-lg font-bold tracking-tight text-gray-900">PHP example</h3>

<code class="bg-gray-50 border-gray-200 border px-3 py-3 block text-xs rounded-md">
	<pre>
$token = 'Your Token here';

$url = 'https://api.counterify.com';

$params = array(
  'label' => $key, // string
  'count' => $value // integer
);

$headers = array(
  'Authorization: Bearer ' . $token,
  'Content-Type: application/json'
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
</pre></code>


        
</div>


  </div>

</div>

</div>


<div class="mx-auto max-w-7xl text-center mb-10">
        <a href="https://app.counterify.com/signup" type="button" class="rounded-full shadow-md inline-flex bg-indigo-600 py-4 px-6 text-lg font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Signup <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-mr-0.5 ml-2 h-7 w-7">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 15l3-3m0 0l-3-3m3 3h-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
</svg>

</a><p class="text-xs text-gray-600 mt-4 center text-center">No credit card required, signup for free</p>
</div> 



<!-- -->
<footer class="bg-white border-gray-100 border-t-2">
  <div class="mx-auto max-w-7xl py-12 px-6 md:flex md:items-center md:justify-between lg:px-8">
    <div class="flex justify-center space-x-6 md:order-2">
          </div>
    <div class="mt-8 md:order-1 md:mt-0">
      <p class="text-center text-xs leading-5 text-gray-500">&copy; 2023 Ayesa Digital SLU. All rights reserved | Made by <a href="https://www.twitter.com/betoayesa">@betoayesa</a> · Get Help: support@counterify.com</p>
    </div>
  </div>
</footer>


<script>

	$('#counters div dd').each(function(i,item){
		let val = parseInt($(item).text());
		$(item).attr("upto",  val);  
		$(item).text("0");

	});
	let counts=setInterval(updated);


        

    function updated(){
        var active = 0;
        $('dd').each(function(i,item){		  
			
	        var count= parseInt($(item).text()) + 1;
			let upto = parseInt($(item).attr("upto"));
	        if (count <= upto){
				active++;
	            $(item).text(count);
			}
        });
        if (active ==0 ){
            console.log('finished countiong'); clearInterval(counts);
        }
    }

	$('.hamburger_menu').click(function(){
		$('#mobile_menu').toggleClass("hidden")
	})

    </script>
    


  </body>
  </html>
