<? include "menu.php"; ?>
<div class="bg-black sm:px-6 lg:px-0 block mb-10 ">
 


      <!-- Pinned projects -->
      <div id="app" class=" block pt-0 " >

<nav class="flex w-full mx-auto sm:gap-x-8 px-8 py-4 border-b border-gray-800 mb-4  hidden sm:block " aria-label="Breadcrumb">
  <ol role="list" class="flex items-center space-x-4">
    <li>
      <div>
        <a href="https://www.domstry.com" class="text-gray-400 hover:text-gray-500">
          <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z" clip-rule="evenodd" />
          </svg>
          <span class="sr-only">Home</span>
        </a>
      </div>
    </li>
    <li>
      <div class="flex items-center">
        <svg class="h-5 w-5 flex-shrink-0 text-gray-300" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
          <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
        </svg>
        <a href="https://www.domstry.com/domain-list" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Domain List</a>
      </div>
    </li>
    <li>
      <div class="flex items-center">
        <svg class="h-5 w-5 flex-shrink-0 text-gray-300" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
          <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
        </svg>
        <h1 class="ml-4 text-sm font-medium text-gray-400 capitalize" aria-current="page"><?= $SEO_TITLE ?></h1>
      </div>
    </li>
  </ol>
</nav>


<div class="sm:flex sm:min-h-full lg:flex-col lg:inset-y-0 lg:z-50 lg:flex lg:flex-col">

  <div class="mx-auto lg:flex w-full items-start sm:gap-x-8 px-4   min-h-50 ">

    <aside class=" sm:max-w-80 min-w-80 shrink-0 lg:flex lg:justify-start  sm:px-4 flex grow flex-col  overflow-y-auto   px-0    sm:sticky sm:top-2 mt-0  sm:w-96 shrink-0 h-screen ">
  



<form  action="#!" class="space-y-2" id="filters_form" method="get">

   
  
 <!-- <h2 class="text-lg  text-gray-400 font-semibold mb-2">Browse domains</h2> -->
	      <!-- Search field -->

       <!--  <select class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-500 px-4 py-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            <option>Option 1</option>
            <option>Option 2</option>
            <option>Option 3</option>
        </select>

        <select class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-500 px-4 py-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            <option>Option 1</option>
            <option>Option 2</option>
            <option>Option 3</option>
        </select>

        <select class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-500 px-4 py-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            <option>Option 1</option>
            <option>Option 2</option>
            <option>Option 3</option>
        </select>

        <select class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-500 px-4 py-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            <option>Option 1</option>
            <option>Option 2</option>
            <option>Option 3</option>
        </select>

        <select class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-500 px-4 py-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            <option>Option 1</option>
            <option>Option 2</option>
            <option>Option 3</option>
        </select> -->
  
<label class="block  text-xs text-gray-500">Search by title or description</label>
  <input type="text" id="search" name="search" placeholder="Search by keyword in title or description" class="p-1 w-full text-sm px-2 py-2 text-gray-100 rounded border border-gray-700 bg-gray-900">

   <!-- Selects -->
   <!--  <select class="border rounded px-2 py-1">
        <option value="option1">CMS</option>
        <option value="option2">Option 2</option>
        <option value="option3">Option 3</option>
    </select>
    <select class="border rounded px-2 py-1">
        <option value="select1">Language</option>
        <option value="select2">Select 2</option>
        <option value="select3">Select 3</option>
    </select>
    <select class="border rounded px-2 py-1">
        <option value="choice1">Choice 1</option>
        <option value="choice2">Choice 2</option>
        <option value="choice3">Choice 3</option>
    </select>

  -->

  
<!-- 
<label class="block  text-xs text-gray-300">With Email</label>
  <input type="checkbox" id="email" name="email" placeholder="Email" class="p-2 rounded border border-gray-300">

<label class=" block  text-xs text-gray-300">With Phone</label>
  <input type="checkbox" id="phone" name="phone" placeholder="Phone" class="p-2 rounded border border-gray-300">
 -->

<label class="block  text-xs text-gray-500">Technologies used</label>
  <input type="text" id="tech" name="tech" placeholder="Technology"  class="p-1 w-full text-gray-100 text-sm px-2 py-2 rounded border border-gray-700 bg-gray-900"></textarea>


<label class="block  text-xs text-gray-500">Hosting / Network</label>
<input class="p-1 w-full text-gray-100 text-sm px-2 py-2 rounded border border-gray-700 bg-gray-900"  type="text" name="hosting" placeholder="Hosting or network">
<? //include dirname(__FILE__)."/../templates/selects/select_hosting.php"; ?>
  
<!-- 
  <input type="text" id="pr" name="pr" placeholder="PageRank" class="p-2 rounded border border-gray-300">

  <input type="number" id="rank" name="rank" placeholder="Rank" class="p-2 rounded border border-gray-300">

  <input type="number" id="status" name="status" placeholder="Status" class="p-2 rounded border border-gray-300">

  <input type="text" id="speed" name="speed" placeholder="Speed" class="p-2 rounded border border-gray-300"> -->

<label class="block  text-xs text-gray-500">Language</label>
<? include dirname(__FILE__)."/../templates/selects/select_lang.php"; ?>
<label class="block  text-xs text-gray-500">Continent (IP)</label>

  <select  class="p-2 w-full text-gray-100 text-sm  rounded border border-gray-700  bg-gray-900" name="continent">
        <option value="">Any</option>
        
        <option value="AS">Asia</option>
        <option value="NA">North America</option>
        <option value="SA">South America</option>
        <option value="EU">Europe</option>
        <option value="AF">Africa</option>
        <option value="SA">Oceania</option>


    </select> 


<label class="block  text-xs text-gray-500">Country (IP)</label>


<? include dirname(__FILE__)."/../templates/selects/select_country.php"; ?>

<label class="block  text-xs text-gray-500">Domain TLD</label>

<? include dirname(__FILE__)."/../templates/selects/select_ltd.php"; ?>

<label class="block  text-xs text-gray-500">HTTP Status Code</label>
 
  <select  class="p-2 w-full text-gray-100 text-sm  rounded border border-gray-700 bg-gray-900" name="status">
        <option value="">Any</option>
        <option value="200">200</option>
        <option value="<> 200">Not 200</option>
    </select> 

<label class="block  text-xs text-gray-500">Available</label>
 
  <select  class="p-2 w-full text-gray-100 text-sm  rounded border border-gray-700 bg-gray-900" name="available">
        <option value="">Any</option>
        <option value="1">Show domains available for registration only</option>
        <option value="0">Show registered domains only</option>
    </select> 


<!--   <label class="block font-semibold text-xs text-white">.Tld</label>
  <select  class="p-1 w-full text-gray-100 rounded border border-gray-700 bg-gray-800" name="tld">
        <option value="choice1">Any</option>
        <option value="choice2">.com</option>
        <option value="choice3">.net</option>
    </select> -->
 
  <button type="submit" id="search-btn" class="bg-green-800 font-semibold text-sm hover:bg-green-600 text-white px-4 w-full py-2 rounded mt-2" type="submit" >Search &rarr;</button>


  	</form>

      <!-- Left column area -->
    </aside>

    <main class="sm:flex-1 pb-3" id="main-content">
      <!-- Main area APP -->

<? if ($hookBeforeApp): ?>
		<div class="pl-4 pb-4"><?= $hookBeforeApp ?></div>
	<? endif; ?>


	      
	    <? include dirname(__FILE__)."/../templates/loading.php"; ?>

  
 



<div>
  


<section class="border-b border-gray-800 py-16 text-gray-500">
<div class="">
  <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="lg:text-center">
      <h3 class="text-sm font-bold leading-8 uppercase  tracking-tight text-gray-400  sm:leading-9">
        Popular
      </h3>
    </div>
     <div class="mt-10">
      <ul class="md:grid md:grid-cols-4  gap-4">
        <li><a href="domain-list/tld/ai">.ai domains list</a></li>
        <li><a href="domain-list/tech/wordpress">Websites using WordPress</a></li>
<li><a href="domain-list/tech/shopify">Websites using Shopify</a></li>
<li><a href="domain-list/tech/prestashop">Websites using Prestashop</a></li>
<li><a href="domain-list/tech/magento">Websites using Magento</a></li>
<li><a href="domain-list/tech/ganalytics">Websites using Google Analytics</a></li>
<li><a href="domain-list/tech/cloudflare">Websites using Cloudflare</a></li>
        </ul>
    </div>
</div>
</div>
</section>

<section class="border-b border-gray-800 py-16 text-gray-500">
<div class="">
  <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="lg:text-center">
      <h3 class="text-sm font-bold leading-8 uppercase  tracking-tight text-gray-400   sm:leading-9">
        Domains by continent
      </h3>
    </div>

    <div class="mt-10">
      <ul class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-8">
        
        <!-- Lead Generation -->
        <li class="flex flex-col items-center text-center">
          <div class="flex-shrink-0">
            <!-- Use the 'lightning-bolt' icon from Heroicons for Lead Generation -->
         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 0 1-1.161.886l-.143.048a1.107 1.107 0 0 0-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 0 1-1.652.928l-.679-.906a1.125 1.125 0 0 0-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 0 0-8.862 12.872M12.75 3.031a9 9 0 0 1 6.69 14.036m0 0-.177-.529A2.25 2.25 0 0 0 17.128 15H16.5l-.324-.324a1.453 1.453 0 0 0-2.328.377l-.036.073a1.586 1.586 0 0 1-.982.816l-.99.282c-.55.157-.894.702-.8 1.267l.073.438c.08.474.49.821.97.821.846 0 1.598.542 1.865 1.345l.215.643m5.276-3.67a9.012 9.012 0 0 1-5.276 3.67m0 0a9 9 0 0 1-10.275-4.835M15.75 9c0 .896-.393 1.7-1.016 2.25" />
</svg>


          </div>
          <div class="mt-3">
            <a href="domain-list/continent/as" class="mt-2 text-base leading-6 text-gray-500 hover:text-gray-700">
              ASIA
            </a>
           
          </div>
        </li>

        <!-- Sales Intelligence -->
        <li class="flex flex-col items-center text-center">
          <div class="flex-shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
  <path stroke-linecap="round" stroke-linejoin="round" d="m20.893 13.393-1.135-1.135a2.252 2.252 0 0 1-.421-.585l-1.08-2.16a.414.414 0 0 0-.663-.107.827.827 0 0 1-.812.21l-1.273-.363a.89.89 0 0 0-.738 1.595l.587.39c.59.395.674 1.23.172 1.732l-.2.2c-.212.212-.33.498-.33.796v.41c0 .409-.11.809-.32 1.158l-1.315 2.191a2.11 2.11 0 0 1-1.81 1.025 1.055 1.055 0 0 1-1.055-1.055v-1.172c0-.92-.56-1.747-1.414-2.089l-.655-.261a2.25 2.25 0 0 1-1.383-2.46l.007-.042a2.25 2.25 0 0 1 .29-.787l.09-.15a2.25 2.25 0 0 1 2.37-1.048l1.178.236a1.125 1.125 0 0 0 1.302-.795l.208-.73a1.125 1.125 0 0 0-.578-1.315l-.665-.332-.091.091a2.25 2.25 0 0 1-1.591.659h-.18c-.249 0-.487.1-.662.274a.931.931 0 0 1-1.458-1.137l1.411-2.353a2.25 2.25 0 0 0 .286-.76m11.928 9.869A9 9 0 0 0 8.965 3.525m11.928 9.868A9 9 0 1 1 8.965 3.525" />
</svg>
          </div>
          <div class="mt-3">
            <a href="domain-list/continent/af" class="mt-2 text-base leading-6 text-gray-500 hover:text-gray-700">
              AFRICA
            </a>
           
          </div>
        </li>

        <!-- Statistics and Research -->
        <li class="flex flex-col items-center text-center">
          <div class="flex-shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
  <path stroke-linecap="round" stroke-linejoin="round" d="m20.893 13.393-1.135-1.135a2.252 2.252 0 0 1-.421-.585l-1.08-2.16a.414.414 0 0 0-.663-.107.827.827 0 0 1-.812.21l-1.273-.363a.89.89 0 0 0-.738 1.595l.587.39c.59.395.674 1.23.172 1.732l-.2.2c-.212.212-.33.498-.33.796v.41c0 .409-.11.809-.32 1.158l-1.315 2.191a2.11 2.11 0 0 1-1.81 1.025 1.055 1.055 0 0 1-1.055-1.055v-1.172c0-.92-.56-1.747-1.414-2.089l-.655-.261a2.25 2.25 0 0 1-1.383-2.46l.007-.042a2.25 2.25 0 0 1 .29-.787l.09-.15a2.25 2.25 0 0 1 2.37-1.048l1.178.236a1.125 1.125 0 0 0 1.302-.795l.208-.73a1.125 1.125 0 0 0-.578-1.315l-.665-.332-.091.091a2.25 2.25 0 0 1-1.591.659h-.18c-.249 0-.487.1-.662.274a.931.931 0 0 1-1.458-1.137l1.411-2.353a2.25 2.25 0 0 0 .286-.76m11.928 9.869A9 9 0 0 0 8.965 3.525m11.928 9.868A9 9 0 1 1 8.965 3.525" />
</svg>


          </div>
          <div class="mt-3">
            <a href="domain-list/continent/eu" class="mt-2 text-base leading-6 text-gray-500 hover:text-gray-700">
              EUROPE
            </a>
         
          </div>
        </li>

        <!-- Market Share -->
        <li class="flex flex-col items-center text-center">
          <div class="flex-shrink-0">
           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
  <path stroke-linecap="round" stroke-linejoin="round" d="m6.115 5.19.319 1.913A6 6 0 0 0 8.11 10.36L9.75 12l-.387.775c-.217.433-.132.956.21 1.298l1.348 1.348c.21.21.329.497.329.795v1.089c0 .426.24.815.622 1.006l.153.076c.433.217.956.132 1.298-.21l.723-.723a8.7 8.7 0 0 0 2.288-4.042 1.087 1.087 0 0 0-.358-1.099l-1.33-1.108c-.251-.21-.582-.299-.905-.245l-1.17.195a1.125 1.125 0 0 1-.98-.314l-.295-.295a1.125 1.125 0 0 1 0-1.591l.13-.132a1.125 1.125 0 0 1 1.3-.21l.603.302a.809.809 0 0 0 1.086-1.086L14.25 7.5l1.256-.837a4.5 4.5 0 0 0 1.528-1.732l.146-.292M6.115 5.19A9 9 0 1 0 17.18 4.64M6.115 5.19A8.965 8.965 0 0 1 12 3c1.929 0 3.716.607 5.18 1.64" />
</svg>

          </div>
          <div class="mt-3">
            <a href="domain-list/continent/na" class="mt-2 text-base leading-6 text-gray-500 hover:text-gray-700">
              NORTH AMERICA
            </a>
          
          </div>
        </li>

        <!-- eCommerce Data -->
        <li class="flex flex-col items-center text-center">
          <div class="flex-shrink-0">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
  <path stroke-linecap="round" stroke-linejoin="round" d="m6.115 5.19.319 1.913A6 6 0 0 0 8.11 10.36L9.75 12l-.387.775c-.217.433-.132.956.21 1.298l1.348 1.348c.21.21.329.497.329.795v1.089c0 .426.24.815.622 1.006l.153.076c.433.217.956.132 1.298-.21l.723-.723a8.7 8.7 0 0 0 2.288-4.042 1.087 1.087 0 0 0-.358-1.099l-1.33-1.108c-.251-.21-.582-.299-.905-.245l-1.17.195a1.125 1.125 0 0 1-.98-.314l-.295-.295a1.125 1.125 0 0 1 0-1.591l.13-.132a1.125 1.125 0 0 1 1.3-.21l.603.302a.809.809 0 0 0 1.086-1.086L14.25 7.5l1.256-.837a4.5 4.5 0 0 0 1.528-1.732l.146-.292M6.115 5.19A9 9 0 1 0 17.18 4.64M6.115 5.19A8.965 8.965 0 0 1 12 3c1.929 0 3.716.607 5.18 1.64" />
</svg>

          </div>
          <div class="mt-3">
            <a href="domain-list/continent/sa" class="mt-2 text-base leading-6 text-gray-500 hover:text-gray-700">
              SOUTH AMERICA
            </a>
            
          </div>
        </li>
 <li class="flex flex-col items-center text-center">
          <div class="flex-shrink-0">
            <!-- Use the 'lightning-bolt' icon from Heroicons for Lead Generation -->
         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 0 1-1.161.886l-.143.048a1.107 1.107 0 0 0-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 0 1-1.652.928l-.679-.906a1.125 1.125 0 0 0-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 0 0-8.862 12.872M12.75 3.031a9 9 0 0 1 6.69 14.036m0 0-.177-.529A2.25 2.25 0 0 0 17.128 15H16.5l-.324-.324a1.453 1.453 0 0 0-2.328.377l-.036.073a1.586 1.586 0 0 1-.982.816l-.99.282c-.55.157-.894.702-.8 1.267l.073.438c.08.474.49.821.97.821.846 0 1.598.542 1.865 1.345l.215.643m5.276-3.67a9.012 9.012 0 0 1-5.276 3.67m0 0a9 9 0 0 1-10.275-4.835M15.75 9c0 .896-.393 1.7-1.016 2.25" />
</svg>


          </div>
          <div class="mt-3">
            <a href="domain-list/continent/oc" class="mt-2 text-base leading-6 text-gray-500 hover:text-gray-700">
              OCEANIA
            </a>
            
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>

</section>


<section class="border-b border-gray-800 py-16 text-gray-500">
<div class="">
  <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="lg:text-center">
      <h3 class="text-sm font-bold leading-8 uppercase  tracking-tight text-gray-400   sm:leading-9">
        List of domains
      </h3>
    </div>

    <div class="mt-10">
      <ul class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8">
        
        <!-- Lead Generation -->
        <li class="flex flex-col items-center text-center">
          <div class="flex-shrink-0">
            <!-- Use the 'lightning-bolt' icon from Heroicons for Lead Generation -->
       <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
  <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
</svg>



          </div>
          <div class="mt-3">
            <a href="browse/country" class="mt-2 text-base leading-6 text-gray-500 hover:text-gray-700">
              Domains by country
            </a>
           
          </div>
        </li>

        <!-- Sales Intelligence -->
        <li class="flex flex-col items-center text-center">
          <div class="flex-shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
  <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 14.25h13.5m-13.5 0a3 3 0 0 1-3-3m3 3a3 3 0 1 0 0 6h13.5a3 3 0 1 0 0-6m-16.5-3a3 3 0 0 1 3-3h13.5a3 3 0 0 1 3 3m-19.5 0a4.5 4.5 0 0 1 .9-2.7L5.737 5.1a3.375 3.375 0 0 1 2.7-1.35h7.126c1.062 0 2.062.5 2.7 1.35l2.587 3.45a4.5 4.5 0 0 1 .9 2.7m0 0a3 3 0 0 1-3 3m0 3h.008v.008h-.008v-.008Zm0-6h.008v.008h-.008v-.008Zm-3 6h.008v.008h-.008v-.008Zm0-6h.008v.008h-.008v-.008Z" />
</svg>

          </div>
          <div class="mt-3">
            <a href="browse/hosting" class="mt-2 text-base leading-6 text-gray-500 hover:text-gray-700">
              Domains by network / hosting
            </a>
           
          </div>
        </li>

        <!-- Statistics and Research -->
        <li class="flex flex-col items-center text-center">
          <div class="flex-shrink-0">
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
</svg>


          </div>
          <div class="mt-3">
            <a href="browse/lang" class="mt-2 text-base leading-6 text-gray-500 hover:text-gray-700">
              Domains by language
            </a>
         
          </div>
        </li>

        <!-- Market Share -->
        <li class="flex flex-col items-center text-center">
          <div class="flex-shrink-0">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
  <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 6.087c0-.355.186-.676.401-.959.221-.29.349-.634.349-1.003 0-1.036-1.007-1.875-2.25-1.875s-2.25.84-2.25 1.875c0 .369.128.713.349 1.003.215.283.401.604.401.959v0a.64.64 0 0 1-.657.643 48.39 48.39 0 0 1-4.163-.3c.186 1.613.293 3.25.315 4.907a.656.656 0 0 1-.658.663v0c-.355 0-.676-.186-.959-.401a1.647 1.647 0 0 0-1.003-.349c-1.036 0-1.875 1.007-1.875 2.25s.84 2.25 1.875 2.25c.369 0 .713-.128 1.003-.349.283-.215.604-.401.959-.401v0c.31 0 .555.26.532.57a48.039 48.039 0 0 1-.642 5.056c1.518.19 3.058.309 4.616.354a.64.64 0 0 0 .657-.643v0c0-.355-.186-.676-.401-.959a1.647 1.647 0 0 1-.349-1.003c0-1.035 1.008-1.875 2.25-1.875 1.243 0 2.25.84 2.25 1.875 0 .369-.128.713-.349 1.003-.215.283-.4.604-.4.959v0c0 .333.277.599.61.58a48.1 48.1 0 0 0 5.427-.63 48.05 48.05 0 0 0 .582-4.717.532.532 0 0 0-.533-.57v0c-.355 0-.676.186-.959.401-.29.221-.634.349-1.003.349-1.035 0-1.875-1.007-1.875-2.25s.84-2.25 1.875-2.25c.37 0 .713.128 1.003.349.283.215.604.401.96.401v0a.656.656 0 0 0 .658-.663 48.422 48.422 0 0 0-.37-5.36c-1.886.342-3.81.574-5.766.689a.578.578 0 0 1-.61-.58v0Z" />
</svg>


          </div>
          <div class="mt-3">
            <a href="builtwith" class="mt-2 text-base leading-6 text-gray-500 hover:text-gray-700">
              Domains by Technology
            </a>
          
          </div>
        </li>

        <!-- eCommerce Data -->
        <li class="flex flex-col items-center text-center">
          <div class="flex-shrink-0">
         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
  <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
</svg>


          </div>
          <div class="mt-3">
            <a href="expired-domains" class="mt-2 text-base leading-6 text-gray-500 hover:text-gray-700">
              Domains by expiration date
            </a>
            
          </div>
        </li>
 
      </ul>
    </div>
  </div>
</div>

</section>




    </main>
<!-- 
    <aside class="sm:sticky sm:top-8 mt-5 sm:mt-0  sm:w-96 shrink-1   ">
      
 

    </aside> -->

  </div>

</div>

   
</main>
</div>
</div>
</div>
</div>


<? if (isset($currentQuery)): ?>
	<script>
		var currentQuery = JSON.parse('<?= json_encode($currentQuery) ?>') ;
        console.log('CURRENT QUERY:',currentQuery);
        var isAuthorized = <?= $isAuthenticated ? 1:0 ?>;
	</script>
<? endif; ?>

<? include "app/templates/row-template.php"; ?>
<? #include "app/templates/modal-send.php"; ?>
<? include "app/templates/section-table.php"; ?>
<? #include "app/templates/section-segment.php"; ?>
<? #include "app/templates/section-logs.php"; ?>

<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "WebSite",
  "url": "https://www.domstry.com/",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "https://www.domstry.com/domain-list?search={search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script>


<script src="https://cdn.jsdelivr.net/npm/underscore@1.13.4/underscore-umd-min.js" ></script>
<script src="<?= APP_CDN ?>backbone.js"></script>

<script src="<?= APP_CDN ?>app.js" ></script>


<? include "footer.php"; ?>
