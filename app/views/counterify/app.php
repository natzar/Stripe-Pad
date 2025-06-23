<style>
.dragging {
  opacity: 0.5;
}
</style>
<!-- <nav class="flex border-t border-b border-gray-200 bg-white  sm:relative w-full" style="" aria-label="Breadcrumb">
  <ol role="list" class="mx-auto flex w-full  space-x-4 px-4 sm:px-6 lg:px-8">
    <li class="flex">
      <div class="flex items-center">
        <a href="<?= APP_BASE_URL ?>" class="text-gray-400 hover:text-gray-500">
          <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z" clip-rule="evenodd" />
          </svg>
          <span class="sr-only">Home</span>
        </a>
      </div>
    </li>

    <li class="flex">
      <div class="flex items-center">
        <svg class="h-full w-6 flex-shrink-0 text-gray-200" viewBox="0 0 24 44" preserveAspectRatio="none" fill="currentColor" aria-hidden="true">
          <path d="M.293 0l22 22-22 22h1.414l22-22-22-22H.293z" />
        </svg>
        <a href="#" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Counters</a>
      </div>
    </li>


    <li class="flex">
      <div class="flex items-center">
        <svg class="h-full w-6 flex-shrink-0 text-gray-200" viewBox="0 0 24 44" preserveAspectRatio="none" fill="currentColor" aria-hidden="true">
          <path d="M.293 0l22 22-22 22h1.414l22-22-22-22H.293z" />
        </svg>
        <a href="#" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700" aria-current="page">Project Nero</a>
      </div>
    </li>

  </ol>
</nav> -->


<div id="app" class="lg:max-w-7xl lg:mx-auto py-16 sm:py-24">
	<div id="header" ></div>
	<div id="main" class="px-4" style=""> 
	


<div id="groups" class="hidden lg:block"></div>

<div>
	          

  <div class="hidden sm:block my-5">
    <nav class="flex space-x-4" aria-label="Tabs">

 <a href="#" filterBy="total" class="date-filter bg-indigo-100 text-indigo-700 rounded-md px-3 py-2 text-sm font-medium">Total</a>

      <a href="#" filterBy="week" class="date-filter text-gray-500 hover:text-gray-700 rounded-md px-3 py-2 text-sm font-medium" >This Week</a>
      
      <a href="#"  filterBy="month"  class="date-filter text-gray-500 hover:text-gray-700 rounded-md px-3 py-2 text-sm font-medium">This Month</a>

      <a href="#"  filterBy="year"  class="date-filter text-gray-500 hover:text-gray-700 rounded-md px-3 py-2 text-sm font-medium">This Year</a>



     


<a href="#" onclick="COUNTERIFY.addNewCounter(event);" class="relative  inline-flex  ml-auto items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" style="margin-left:auto;">

            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            <span>New counter</span>
          </a>
    
<!--     <a href="#" onclick="COUNTERIFY.export();" class="inline-flex  items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gray-500 shadow-sm hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" >

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 -ml-1 mr-2">
  <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
</svg>

            <span>Export</span>
          </a>
 -->
    </nav>
  </div>
</div>







<div id="dashboard" class="section py-32"></div>  
<div id="logs" class="section"></div>
<div id="stats" class="section"></div>
<div id="settings" class="section"></div>
<? include "modal.php"; ?>

<div id="loading" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
  <div class="bg-white p-6 rounded-md shadow-lg">
    <div class="flex items-center mb-4">
      <svg class="animate-spin mr-4 h-5 w-5 text-gray-400" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.546A8 8 0 014.454 7.998H2A10 10 0 002 12v.546zm10 6.408A8 8 0 0119.546 12H22a10 10 0 00-2-5.546V12zm-10 0v-2.408h8v2.408H6zm10-2.408v2.408h-8v-2.408h8z"></path>
      </svg>
      <br>
      <span class="text-gray-700">Loading...</span>
    </div>
  </div>
</div>



<!-- Only for mobile -->
<footer style="position:fixed;bottom:0px;left:0px;right:0px;z-index: 90" class=" sm:hidden bg-white px-4 py-2">
 <button type="button" id="add-new-activity" class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
      
          Create new counter
        </button>
</footer>

<!-- Footer button -->

</div></div>


<script id="groups-template" type="text/x-handlebars-template"><? include "app/groups-menu.php"; ?></script>
<script id="groups-mobile-template" type="text/x-handlebars-template"><? include "app/groups-menu-mobile.php"; ?></script>

<script id="logs-template" type="text/x-handlebars-template"><? include "app/logs.php"; ?></script>
<script id="stats-template" type="text/x-handlebars-template"><? include "app/stats.php"; ?></script>
<script id="counters-template" type="text/x-handlebars-template"><? include "app/counters.php"; ?></script>
<script id="empty-template" type="text/x-handlebars-template"><? include "app/empty.php"; ?></script> 
<script id="dashboard-template" type="text/x-handlebars-template"><? include "app/dashboard.php"; ?></script>
<script id="settings-template" type="text/x-handlebars-template"><? include "app/settings.php"; ?></script>
<script id="counter-modal-template" type="text/x-handlebars-template"><? include "app/counterModal.php"; ?></script>

 <!--  Scripts-->

<script> 
	var BASE_URL = '<?= APP_BASE_URL ?>';
	var API_BASE_URL = '<?= API_BASE_URL ?>';
	var LANG = '<?= $_SESSION['lang'] ?>';	
	var CONFIG = {
		customersId: <?= $_SESSION['user']['customersId'] ?>,
		usersId: <?= $_SESSION['user']['usersId'] ?>,
		bearer: '<?= sha1($_SESSION['user']['customersId'].$_SESSION['user']['usersId'].$_SESSION['user']['email']) ?>'
	};

	$('.hamburger_menu').click(function(){
		$('#mobile_menu').toggleClass("hidden")
	})

</script>

<? include "app/upgrade.php"; ?>




<!-- Js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<? if ($_SESSION['lang'] != "en"): ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/<?= $_SESSION['lang'] ?>.js"></script> 
<? endif; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.12/handlebars.min.js"></script>
<script src="assets/backbone.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	  


<!-- App Js -->
<script type="text/javascript" src="assets/app.js"></script>
