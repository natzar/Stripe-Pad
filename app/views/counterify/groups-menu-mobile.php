 <a href="#" onclick="javascript:COUNTERIFY.filterByGroup(event);" groupsId="0" class="group-default group-item bg-indigo-50 border-indigo-500 text-indigo-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium sm:pl-5 sm:pr-6">Uncategorized</a>

{{#each collection}}
 <a href="#" onclick="javascript:COUNTERIFY.filterByGroup(event);" groupsId="{{groupsId}}" class="group-default group-item hover:bg-indigo-50 hover:border-indigo-500 hover:text-indigo-700 block pl-3 pr-4 py-2 hover:border-l-4 text-base font-medium sm:pl-5 sm:pr-6">{{capitalizeFirst label}}</a>
      {{/each}}
