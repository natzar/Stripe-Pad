<header class="py-6  bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex items-center space-x-4 ">
        <h1 class="text-3xl font-bold tracking-tight text-gray-100">Superadmin's Special Dashboard</h1>
        <!-- <p class="text-base leading-8 text-gray-300">You are signed up as "<?= $_SESSION['user']['group'] ?>" - Only registered users can see this</p> -->

    </div>

</header>



<div class="flex min-h-screen flex-col bg-gray-800">


    <div class="mx-auto flex min-h-screen w-full max-w-7xl items-start gap-x-8 px-4 py-10 sm:px-6 lg:px-8">
        <? include_once dirname(__FILE__) . "/../layout/sidebar-private.php"; ?>


        <main class="flex-1 text-gray-100">
            <span class="isolate inline-flex rounded-md shadow-sm">
                <button type="button" class="relative inline-flex items-center rounded-l-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">Years</button>
                <button type="button" class="relative -ml-px inline-flex items-center bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">Months</button>
                <button type="button" class="relative -ml-px inline-flex items-center rounded-r-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">Days</button>
            </span>

            <canvas id="trafficChart"></canvas>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var ctx = document.getElementById('trafficChart').getContext('2d');
                    var trafficData = {
                        labels: Array.from({
                            length: 365
                        }, (_, i) => new Date(2023, 0, i + 1).toLocaleDateString('en-US')),
                        datasets: [{
                            label: 'Daily Website Visits',
                            data: Array.from({
                                length: 365
                            }, () => Math.floor(Math.random() * 200 + 100)),
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    };

                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: trafficData,
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
            </script>

            <div class="mx-auto max-w-7xl ">
                <div class="mx-auto max-w-2xl lg:max-w-none">

                    <dl class="mt-16 grid grid-cols-1 gap-0.5 overflow-hidden rounded-2xl text-center sm:grid-cols-2 lg:grid-cols-4">
                        <div class="flex flex-col bg-white/5 p-8">
                            <dt class="text-sm/6 font-semibold text-gray-300">Creators on the platform</dt>
                            <dd class="order-first text-3xl font-semibold tracking-tight text-white">8,000+</dd>
                        </div>
                        <div class="flex flex-col bg-white/5 p-8">
                            <dt class="text-sm/6 font-semibold text-gray-300">Flat platform fee</dt>
                            <dd class="order-first text-3xl font-semibold tracking-tight text-white">3%</dd>
                        </div>
                        <div class="flex flex-col bg-white/5 p-8">
                            <dt class="text-sm/6 font-semibold text-gray-300">Uptime guarantee</dt>
                            <dd class="order-first text-3xl font-semibold tracking-tight text-white">99.9%</dd>
                        </div>
                        <div class="flex flex-col bg-white/5 p-8">
                            <dt class="text-sm/6 font-semibold text-gray-300">Paid out to creators</dt>
                            <dd class="order-first text-3xl font-semibold tracking-tight text-white">$70M</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <div class="space-y-16 py-16 xl:space-y-20">
                <!-- Recent activity table -->
                <div>
                    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <h2 class="mx-auto max-w-2xl text-base font-semibold text-gray-100 lg:mx-0 lg:max-w-none">Recent activity</h2>
                    </div>
                    <div class="mt-6 overflow-hidden border-t border-gray-100">
                        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                            <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-none">
                                <table class="w-full text-left">
                                    <thead class="sr-only">
                                        <tr>
                                            <th>Amount</th>
                                            <th class="hidden sm:table-cell">Client</th>
                                            <th>More details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-sm/6 text-gray-900">
                                            <th scope="colgroup" colspan="3" class="relative isolate py-2 font-semibold">
                                                <time datetime="2023-03-22">Today</time>
                                                <div class="absolute inset-y-0 right-full -z-10 w-screen border-b border-gray-200 bg-gray-50"></div>
                                                <div class="absolute inset-y-0 left-0 -z-10 w-screen border-b border-gray-200 bg-gray-50"></div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td class="relative py-5 pr-6">
                                                <div class="flex gap-x-6">
                                                    <svg class="hidden h-6 w-5 flex-none text-gray-400 sm:block" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm-.75-4.75a.75.75 0 0 0 1.5 0V8.66l1.95 2.1a.75.75 0 1 0 1.1-1.02l-3.25-3.5a.75.75 0 0 0-1.1 0L6.2 9.74a.75.75 0 1 0 1.1 1.02l1.95-2.1v4.59Z" clip-rule="evenodd" />
                                                    </svg>
                                                    <div class="flex-auto">
                                                        <div class="flex items-start gap-x-3">
                                                            <div class="text-sm/6 font-medium text-gray-900">$7,600.00 USD</div>
                                                            <div class="rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Paid</div>
                                                        </div>
                                                        <div class="mt-1 text-xs/5 text-gray-500">$500.00 tax</div>
                                                    </div>
                                                </div>
                                                <div class="absolute bottom-0 right-full h-px w-screen bg-gray-100"></div>
                                                <div class="absolute bottom-0 left-0 h-px w-screen bg-gray-100"></div>
                                            </td>
                                            <td class="hidden py-5 pr-6 sm:table-cell">
                                                <div class="text-sm/6 text-gray-900">Reform</div>
                                                <div class="mt-1 text-xs/5 text-gray-500">Website redesign</div>
                                            </td>
                                            <td class="py-5 text-right">
                                                <div class="flex justify-end">
                                                    <a href="#" class="text-sm/6 font-medium text-indigo-600 hover:text-indigo-500">View<span class="hidden sm:inline"> transaction</span><span class="sr-only">, invoice #00012, Reform</span></a>
                                                </div>
                                                <div class="mt-1 text-xs/5 text-gray-500">Invoice <span class="text-gray-900">#00012</span></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="relative py-5 pr-6">
                                                <div class="flex gap-x-6">
                                                    <svg class="hidden h-6 w-5 flex-none text-gray-400 sm:block" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-11.25a.75.75 0 0 0-1.5 0v4.59L7.3 9.24a.75.75 0 0 0-1.1 1.02l3.25 3.5a.75.75 0 0 0 1.1 0l3.25-3.5a.75.75 0 1 0-1.1-1.02l-1.95 2.1V6.75Z" clip-rule="evenodd" />
                                                    </svg>
                                                    <div class="flex-auto">
                                                        <div class="flex items-start gap-x-3">
                                                            <div class="text-sm/6 font-medium text-gray-900">$10,000.00 USD</div>
                                                            <div class="rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">Withdraw</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="absolute bottom-0 right-full h-px w-screen bg-gray-100"></div>
                                                <div class="absolute bottom-0 left-0 h-px w-screen bg-gray-100"></div>
                                            </td>
                                            <td class="hidden py-5 pr-6 sm:table-cell">
                                                <div class="text-sm/6 text-gray-900">Tom Cook</div>
                                                <div class="mt-1 text-xs/5 text-gray-500">Salary</div>
                                            </td>
                                            <td class="py-5 text-right">
                                                <div class="flex justify-end">
                                                    <a href="#" class="text-sm/6 font-medium text-indigo-600 hover:text-indigo-500">View<span class="hidden sm:inline"> transaction</span><span class="sr-only">, invoice #00011, Tom Cook</span></a>
                                                </div>
                                                <div class="mt-1 text-xs/5 text-gray-500">Invoice <span class="text-gray-900">#00011</span></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="relative py-5 pr-6">
                                                <div class="flex gap-x-6">
                                                    <svg class="hidden h-6 w-5 flex-none text-gray-400 sm:block" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                                        <path fill-rule="evenodd" d="M15.312 11.424a5.5 5.5 0 0 1-9.201 2.466l-.312-.311h2.433a.75.75 0 0 0 0-1.5H3.989a.75.75 0 0 0-.75.75v4.242a.75.75 0 0 0 1.5 0v-2.43l.31.31a7 7 0 0 0 11.712-3.138.75.75 0 0 0-1.449-.39Zm1.23-3.723a.75.75 0 0 0 .219-.53V2.929a.75.75 0 0 0-1.5 0V5.36l-.31-.31A7 7 0 0 0 3.239 8.188a.75.75 0 1 0 1.448.389A5.5 5.5 0 0 1 13.89 6.11l.311.31h-2.432a.75.75 0 0 0 0 1.5h4.243a.75.75 0 0 0 .53-.219Z" clip-rule="evenodd" />
                                                    </svg>
                                                    <div class="flex-auto">
                                                        <div class="flex items-start gap-x-3">
                                                            <div class="text-sm/6 font-medium text-gray-900">$2,000.00 USD</div>
                                                            <div class="rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">Overdue</div>
                                                        </div>
                                                        <div class="mt-1 text-xs/5 text-gray-500">$130.00 tax</div>
                                                    </div>
                                                </div>
                                                <div class="absolute bottom-0 right-full h-px w-screen bg-gray-100"></div>
                                                <div class="absolute bottom-0 left-0 h-px w-screen bg-gray-100"></div>
                                            </td>
                                            <td class="hidden py-5 pr-6 sm:table-cell">
                                                <div class="text-sm/6 text-gray-900">Tuple</div>
                                                <div class="mt-1 text-xs/5 text-gray-500">Logo design</div>
                                            </td>
                                            <td class="py-5 text-right">
                                                <div class="flex justify-end">
                                                    <a href="#" class="text-sm/6 font-medium text-indigo-600 hover:text-indigo-500">View<span class="hidden sm:inline"> transaction</span><span class="sr-only">, invoice #00009, Tuple</span></a>
                                                </div>
                                                <div class="mt-1 text-xs/5 text-gray-500">Invoice <span class="text-gray-900">#00009</span></div>
                                            </td>
                                        </tr>

                                        <tr class="text-sm/6 text-gray-900">
                                            <th scope="colgroup" colspan="3" class="relative isolate py-2 font-semibold">
                                                <time datetime="2023-03-21">Yesterday</time>
                                                <div class="absolute inset-y-0 right-full -z-10 w-screen border-b border-gray-200 bg-gray-50"></div>
                                                <div class="absolute inset-y-0 left-0 -z-10 w-screen border-b border-gray-200 bg-gray-50"></div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td class="relative py-5 pr-6">
                                                <div class="flex gap-x-6">
                                                    <svg class="hidden h-6 w-5 flex-none text-gray-400 sm:block" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm-.75-4.75a.75.75 0 0 0 1.5 0V8.66l1.95 2.1a.75.75 0 1 0 1.1-1.02l-3.25-3.5a.75.75 0 0 0-1.1 0L6.2 9.74a.75.75 0 1 0 1.1 1.02l1.95-2.1v4.59Z" clip-rule="evenodd" />
                                                    </svg>
                                                    <div class="flex-auto">
                                                        <div class="flex items-start gap-x-3">
                                                            <div class="text-sm/6 font-medium text-gray-900">$14,000.00 USD</div>
                                                            <div class="rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Paid</div>
                                                        </div>
                                                        <div class="mt-1 text-xs/5 text-gray-500">$900.00 tax</div>
                                                    </div>
                                                </div>
                                                <div class="absolute bottom-0 right-full h-px w-screen bg-gray-100"></div>
                                                <div class="absolute bottom-0 left-0 h-px w-screen bg-gray-100"></div>
                                            </td>
                                            <td class="hidden py-5 pr-6 sm:table-cell">
                                                <div class="text-sm/6 text-gray-900">SavvyCal</div>
                                                <div class="mt-1 text-xs/5 text-gray-500">Website redesign</div>
                                            </td>
                                            <td class="py-5 text-right">
                                                <div class="flex justify-end">
                                                    <a href="#" class="text-sm/6 font-medium text-indigo-600 hover:text-indigo-500">View<span class="hidden sm:inline"> transaction</span><span class="sr-only">, invoice #00010, SavvyCal</span></a>
                                                </div>
                                                <div class="mt-1 text-xs/5 text-gray-500">Invoice <span class="text-gray-900">#00010</span></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </main>
    </div>
</div>