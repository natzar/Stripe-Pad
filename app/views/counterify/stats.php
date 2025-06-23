<nav>
	<div class="nav-wrapper orange darken-4">
      <div class="col s12">
        <a href="#orders" class="breadcrumb">Ordenes</a>
		<a href="#!" class="breadcrumb">{{name}}</a>
      </div>
    </div>
</nav>

<div>
  <h3 class="text-base font-semibold leading-6 text-gray-900">Last 30 days</h3>
  <dl class="mt-5 grid grid-cols-2 gap-5 sm:grid-cols-3">
	  
	  {{#each collection}}



    <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
      <dt class="truncate text-sm font-medium text-gray-500">{{name}}</dt>
      <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{counter}}</dd>
    </div>
{{/each}}
     </dl>
</div>



<div class="row" style="padding-top:5px">				
		<a id="" class="btn back"><i class="material-icons left">chevron_left</i> Atrás</a>
	    <a id="" class="btn continue"><i class="material-icons right">chevron_right</i> Continuar</a>				   	
</div>
<div class="row   white-text">
	<div class="input-field white-text col s12">
		<i class="material-icons prefix">search_circle</i>
		<input id="search-products" type="text" class="">
		<label class="white-text" id="" for="search-products">Buscar</label>
	</div>
</div>
<ul class="collection black">  
  	{{#each content}}
	  <li class="collection-item" data-cod="{{cod}}" data-title="{{title}}" data-done="{{done}}" data-to-do="{{to_do}}">{{cod}}<br> {{title}}<div class="right" style="right:15px">{{done}}/{{to_do}}</div></li>
	{{/each}}
</ul>
<div class="row" style="padding-top:5px">				
		<a id="" class="btn back"><i class="material-icons left">chevron_left</i> Atrás</a>
	    <a id="" class="btn continue"><i class="material-icons right">chevron_right</i> Continuar</a>				   	
</div>
