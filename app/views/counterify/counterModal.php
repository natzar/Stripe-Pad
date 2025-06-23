
           
           <!-- content goes here -->
        
           <h2 class="text-base font-semibold leading-6 text-gray-900 mb-4">{{capitalizeFirst label}}</h2>
<h2>Current week number of 2023: {{currentWeekNumber}}</h2>
 <canvas width="200" height="100" class="chart"></canvas>



 

  <div class="mt-8 flow-root">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
        <table class="min-w-full divide-y divide-gray-300">
          <thead>
            <tr>
              <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Week</th>
              <!-- <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">User</th> -->
              <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Count</th>
              <!-- <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Role</th>
              <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                <span class="sr-only">Edit</span>
              </th> -->
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">

          	{{#each history}}
				<tr>
					<td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0 text-left">
{{period}}
					</td>
					<!-- <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">

					</td>
 -->					<td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0 text-left">
				{{counter}}
					</td>
				</tr>
			{{/each}}
<!-- 
            <tr>
              <td >Lindsay Walton</td>
              <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Front-end Developer</td>
              <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">lindsay.walton@example.com</td>
              <td class="">Member</td>
              <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span class="sr-only">, Lindsay Walton</span></a>
              </td>
            </tr>
 -->
            <!-- More people... -->
          </tbody>
        </table>
      </div>
    </div>
  </div>




