
<!-- End filters --->
<div class="pb-10">
  <dl class="mt-5 grid grid-cols-2 gap-5 sm:grid-cols-4  xl:grid-cols-4" id="container">
	 


	  {{#each collection}}

    <div id="counter_{{countersId}}" countersId="{{countersId}}" class="counter overflow-hidden rounded-lg bg-white px-2 py-2 shadow hover:shadow-lg sm:p-6 relative">
	  

	    <div class="counterRemove absolute top-1 right-1 cursor-pointer hidden sm:block">
		   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
  				<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
			</svg>
	    </div>
	      <div class="counterEdit absolute cursor-pointer hidden right-1 sm:inline-block" style="bottom:5px">
	    	<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
  <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
</svg>

		</div>

		<div class="counterGoal absolute hidden cursor-pointer sm:inline-block" style="left:10px;bottom:10px">
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
  <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 002.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 012.916.52 6.003 6.003 0 01-5.395 4.972m0 0a6.726 6.726 0 01-2.749 1.35m0 0a6.772 6.772 0 01-3.044 0" />
</svg>

</div>
      <dt class="counterLabel cursor-pointer truncate text-sm font-medium text-gray-500" >{{capitalizeFirst label}}   </dt>

      <a class="block counterNumber mt-1 cursor-pointer text-3xl font-semibold tracking-tight text-gray-900 hover:text-indigo-400">{{formatNumber total}}</a>
      {{#if goal}}
	<span class="text-xs text-gray-400">Goal: {{total}} / {{goal}}</span>
<div class="w-full bg-gray-200 rounded">
  <div class="h-2 bg-blue-500 rounded" style="width: {{calculatePercentage total goal}}%"></div>
</div>
      {{/if}}
  
    </div>
{{/each}}
     </dl>
</div>



