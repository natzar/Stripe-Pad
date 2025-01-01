<header class="py-6  bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex items-center space-x-4 ">
        <h1 class="text-3xl font-bold tracking-tight text-gray-100">Superadmin's Special Dashboard</h1>
        <!-- <p class="text-base leading-8 text-gray-300">You are signed up as "<?= $_SESSION['user']['group'] ?>" - Only registered users can see this</p> -->

    </div>

</header>



<div class="flex min-h-screen flex-col">


    <div class="mx-auto flex min-h-screen w-full  items-start gap-x-8 px-4 py-10 sm:px-6 lg:px-8">



        <main class="flex-1 text-gray-100">

            <div class="flex items-center gap-x-6 bg-sky-600 hover:bg-sky-900 px-6 py-2.5 sm:px-3.5 sm:before:flex-1 rounded-xl mb-3">
                <p class="text-sm/6 text-white">
                    <a href="javascript:if (confirm('This will import all data from Stripe, don\'t close this tab. Continue?')) window.location.href='<?= APP_DOMAIN ?>actionStripeSync';">
                        <strong class="font-semibold">Stripe Connection</strong><svg viewBox="0 0 2 2" class="mx-2 inline size-0.5 fill-current" aria-hidden="true">
                            <circle cx="1" cy="1" r="1" />
                        </svg> Import products, customers and subscriptions <span aria-hidden="true">&rarr;</span>
                    </a>
                </p>
                <div class="flex flex-1 justify-end">
                    <button type="button" class="-m-3 p-3 focus-visible:outline-offset-[-4px]">
                        <span class="sr-only">Dismiss</span>
                        <svg class="size-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="mx-auto max-w-7xl ">
                <div class="mx-auto max-w-2xl lg:max-w-none">

                    <dl class=" grid grid-cols-1 gap-0.5 overflow-hidden rounded-2xl text-center sm:grid-cols-2 lg:grid-cols-5">
                        <div class="flex flex-col bg-white/5 p-8">
                            <dt class="text-sm/6 font-semibold text-gray-300">Visitors now</dt>
                            <dd class="order-first text-3xl font-semibold tracking-tight text-white">67</dd>
                        </div>
                        <div class="flex flex-col bg-white/5 p-8">
                            <dt class="text-sm/6 font-semibold text-gray-300">Revenue</dt>
                            <dd class="order-first text-3xl font-semibold tracking-tight text-white">$0</dd>
                        </div>
                        <div class="flex flex-col bg-white/5 p-8">
                            <dt class="text-sm/6 font-semibold text-gray-300">$/Visitor</dt>
                            <dd class="order-first text-3xl font-semibold tracking-tight text-white">$0</dd>
                        </div>
                        <div class="flex flex-col bg-white/5 p-8">
                            <dt class="text-sm/6 font-semibold text-gray-300">Session Time</dt>
                            <dd class="order-first text-3xl font-semibold tracking-tight text-white">90s</dd>
                        </div>
                        <div class="flex flex-col bg-white/5 p-8">
                            <dt class="text-sm/6 font-semibold text-gray-300">Bounce Rate</dt>
                            <dd class="order-first text-3xl font-semibold tracking-tight text-white">23%</dd>
                        </div>
                    </dl>
                </div>
            </div>



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
            <!-- <h2 class="mx-auto max-w-2xl text-base font-semibold text-gray-100 lg:mx-0 lg:max-w-none"></h2> -->

            <!-- <span class="isolate inline-flex rounded-md shadow-sm">
                <button type="button" class="relative inline-flex items-center rounded-l-md bg-white/8 px-3 py-2 text-sm font-semibold text-gray-100 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">This Week</button>
                <button type="button" class="relative -ml-px inline-flex items-center bg-gray-900  px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">This Month</button>
                <button type="button" class="relative -ml-px inline-flex items-center rounded-r-md bg-gray-900 px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">This Year</button>
            </span> -->
            <div class="mx-auto max-w-7xl ">
                <div class="mx-auto max-w-2xl lg:max-w-none">

                    <dl class=" grid grid-cols-1 gap-0.5 overflow-hidden rounded-2xl text-center sm:grid-cols-2 lg:grid-cols-5">
                        <div class="flex flex-col bg-white/5 p-8">
                            <dt class="text-sm/6 font-semibold text-gray-300">Visitors</dt>
                            <dd class="order-first text-3xl font-semibold tracking-tight text-white">8,000+</dd>
                        </div>
                        <div class="flex flex-col bg-white/5 p-8">
                            <dt class="text-sm/6 font-semibold text-gray-300">Visitor ➞ User</dt>
                            <dd class="order-first text-3xl font-semibold tracking-tight text-white">3%</dd>
                        </div>
                        <div class="flex flex-col bg-white/5 p-8">
                            <dt class="text-sm/6 font-semibold text-gray-300">Users</dt>
                            <dd class="order-first text-3xl font-semibold tracking-tight text-white">2,098</dd>
                        </div>
                        <div class="flex flex-col bg-white/5 p-8">
                            <dt class="text-sm/6 font-semibold text-gray-300">User ➞ Customer</dt>
                            <dd class="order-first text-3xl font-semibold tracking-tight text-white">0%</dd>
                        </div>
                        <div class="flex flex-col bg-white/5 p-8">
                            <dt class="text-sm/6 font-semibold text-gray-300">Customers</dt>
                            <dd class="order-first text-3xl font-semibold tracking-tight text-white">0</dd>
                        </div>
                    </dl>
                </div>
            </div>
            <section>

                <h2 class="pl-6 mx-auto max-w-2xl text-base font-semibold text-gray-100 py-8 lg:mx-0 lg:max-w-none">Custom Counters</h2>

                <div class="mx-auto max-w-7xl ">
                    <div class="mx-auto max-w-2xl lg:max-w-none">

                        <dl class=" grid grid-cols-1 gap-0.5 overflow-hidden rounded-2xl text-center sm:grid-cols-2 lg:grid-cols-4">
                            <div class="flex flex-col bg-white/5 p-8">
                                <dt class="text-sm/6 font-semibold text-gray-300">Downloads</dt>
                                <dd class="order-first text-3xl font-semibold tracking-tight text-white">8,000+</dd>
                            </div>
                            <div class="flex flex-col bg-white/5 p-8">
                                <dt class="text-sm/6 font-semibold text-gray-300">Redirections to Stripe</dt>
                                <dd class="order-first text-3xl font-semibold tracking-tight text-white">3%</dd>
                            </div>

                        </dl>
                    </div>
                </div>
            </section>
            <div class="space-y-16 py-16 xl:space-y-20">
                <!-- Recent activity table -->
                <div>
                    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <h2 class="mx-auto max-w-2xl text-base font-semibold text-gray-100 lg:mx-0 lg:max-w-none">Recent Activity</h2>
                    </div>
                    <div class="mt-6 overflow-hidden border-t bg-white/5  rounded-xl border-gray-900">
                        <div class="mx-auto max-w-7xl ">
                            <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-none">
                                <table class="w-full text-left">

                                    <tbody>
                                        <?
                                        $last_date = "";
                                        foreach ($log as $item): ?>
                                            <? if (date('Y-m-d H', strtotime($item['updated'])) != date('Y-m-d H', strtotime($last_date))): ?>
                                                <tr class="text-sm/6 text-gray-200 ">
                                                    <th scope="colgroup" colspan="3" class="relative pl-6 isolate py-2 font-semibold">
                                                        <time datetime="2023-03-22"><?= time_elapsed_string($item['updated']) ?></time>
                                                        <div class="absolute inset-y-0 right-full -z-10 w-screen border-b border-gray-900 bg-sky-900"></div>
                                                        <div class="absolute inset-y-0 left-0 -z-10 w-screen border-b border-gray-900 bg-sky-900"></div>
                                                    </th>
                                                </tr>
                                            <?
                                                $last_date = $item['updated'];
                                            endif; ?>
                                            <tr class="border-gray-600 border-1 border-b ">
                                                <td class="relative py-5 pl-6 ">
                                                    <div class="flex gap-x-6">
                                                        <svg class="hidden h-6 w-5 flex-none text-gray-400 sm:block" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm-.75-4.75a.75.75 0 0 0 1.5 0V8.66l1.95 2.1a.75.75 0 1 0 1.1-1.02l-3.25-3.5a.75.75 0 0 0-1.1 0L6.2 9.74a.75.75 0 1 0 1.1 1.02l1.95-2.1v4.59Z" clip-rule="evenodd" />
                                                        </svg>
                                                        <div class="flex-auto">
                                                            <div class="flex items-start gap-x-3">
                                                                <div class="rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20"><?= $item['tag'] ?></div>
                                                                <div class="text-sm/6 font-medium text-gray-400"><?= $item['label'] ?></div>

                                                            </div>
                                                            <div class="mt-1 text-xs/5 text-gray-500"><?= $item['body'] ?></div>
                                                        </div>
                                                    </div>

                                                </td>

                                                <td class="py-5 text-right pr-6">
                                                    <div class="flex justify-end space-x-2">
                                                        <!-- <a href="#" class="text-sm/6 font-medium text-indigo-600 hover:text-indigo-500">View<span class="hidden sm:inline"> transaction</span><span class="sr-only">, invoice #00012, Reform</span></a> -->

                                                        <div class="mt-1 text-xs/5 text-gray-500">Count <span class="text-gray-300"><?= $item['total'] ?></span></div>
                                                        <div class="mt-1 text-xs/5 text-gray-500">Last <span class="text-gray-300"><?= time_elapsed_string($item['updated']) ?></span></div>
                                                    </div>

                                                </td>
                                            </tr>
                                        <? endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <?php


                // Conectar a la base de datos
                $conn = new mysqli(APP_DB_HOST, APP_DB_USER, APP_DB_PASSWORD, APP_DB);

                // Checar conexión


                // Obtener el tamaño de cada tabla
                $sql = "SELECT 
            table_name AS `Table`, 
            round(((data_length + index_length) / 1024 / 1024), 2) `Size in MB` 
        FROM information_schema.TABLES 
        WHERE table_schema = '" . APP_DB . "'
        ORDER BY (data_length + index_length) DESC;";

                $result = $conn->query($sql);

                $tableSizes = [];
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $tableSizes[] = $row;
                    }
                } else {
                    echo "0 results";
                }

                $conn->close();
                ?>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <h2 class="text-white text-lg">Checklist</h2>

                        <ul class="list-disc pl-5 space-y-2">
                            <li>
                                <strong>Gettext Extension:</strong>
                                <?php if (extension_loaded('gettext')) {
                                    echo "<span class='text-green-500'>Available</span>";
                                } else {
                                    echo "<span class='text-red-500'>Not Available</span>";
                                } ?>
                            </li>
                            <li>
                                <strong>PHP Version:</strong>
                                <?php if (version_compare(PHP_VERSION, '7.2', '>=')) {
                                    echo "<span class='text-green-500'>✔︎ PHP version is " . PHP_VERSION . " (>=7.2)</span>";
                                } else {
                                    echo "<span class='text-red-500'>[x] FIX: PHP version is " . PHP_VERSION . "</span>";
                                } ?>
                            </li>
                            <li>
                                <strong>System Function:</strong>
                                <?php if (function_exists('system')) {
                                    echo "<span class='text-green-500'>✔︎ Available</span>";
                                } else {
                                    echo "<span class='text-red-500'>Not Available</span>";
                                } ?>
                            </li>
                            <li>
                                <strong>Exec Function:</strong>
                                <?php if (function_exists('exec')) {
                                    echo "<span class='text-green-500'>✔︎ Available</span>";
                                } else {
                                    echo "<span class='text-red-500'>Not Available</span>";
                                } ?>
                            </li>
                            <li>
                                <strong>MySQL PDO:</strong>
                                <?php if (class_exists('PDO')) {
                                    $drivers = PDO::getAvailableDrivers();
                                    if (in_array('mysql', $drivers)) {
                                        echo "<span class='text-green-500'>✔︎ MySQL PDO is installed.</span>";
                                    } else {
                                        echo "<span class='text-red-500'>[x] MySQL PDO is not available.</span>";
                                    }
                                } else {
                                    echo "<span class='text-red-500'>[x] PDO is not installed.</span>";
                                } ?>
                            </li>
                            <li>
                                <strong>Database Connection:</strong>
                                <?php
                                // Assuming $conn is your database connection variable
                                if (isset($conn) && $conn->connect_error) {
                                    echo "<span class='text-red-500'>[x] " . $conn->connect_error . "</span>";
                                } else {
                                    echo "<span class='text-green-500'>✔︎ Connected successfully</span>";
                                }
                                ?>
                            </li>
                        </ul>


                    </div>
                    <div>
                        <h2 class="text-white text-lg">Database</h2>
                        <canvas id="pieChart" width="400" height="400"></canvas>
                        <script>
                            var ctx = document.getElementById('pieChart').getContext('2d');
                            var pieChart = new Chart(ctx, {
                                type: 'pie',
                                data: {
                                    labels: <?php echo json_encode(array_column($tableSizes, 'Table')); ?>,
                                    datasets: [{
                                        label: 'MB',
                                        data: <?php echo json_encode(array_column($tableSizes, 'Size in MB'), JSON_NUMERIC_CHECK); ?>,
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(255, 206, 86, 0.2)',
                                            'rgba(75, 192, 192, 0.2)',
                                            'rgba(153, 102, 255, 0.2)',
                                            'rgba(255, 159, 64, 0.2)'
                                        ],
                                        borderColor: [
                                            'rgba(255, 99, 132, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',
                                            'rgba(75, 192, 192, 1)',
                                            'rgba(153, 102, 255, 1)',
                                            'rgba(255, 159, 64, 1)'
                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            position: 'top',
                                        },
                                        tooltip: {
                                            mode: 'index',
                                            intersect: false,
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>
                    <div>
                        <h2 class="text-white text-lg">Disk</h2>
                        <?php
                        function getDirectorySize($dir)
                        {
                            $size = 0;
                            foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir)) as $file) {
                                if ($file->isFile()) {
                                    $size += $file->getSize();
                                }
                            }
                            return $size;
                        }

                        $directories = array_filter(glob('./*'), 'is_dir');
                        $dirSizes = [];
                        $dirLabels = [];
                        $dirData = [];
                        foreach ($directories as $dir) {
                            $dirName = basename($dir);
                            $dirSize = getDirectorySize($dir) / 1024 / 1024; // Size in MB
                            $dirSizes[$dirName] = round($dirSize, 2);
                            $dirLabels[] = $dirName;
                            $dirData[] = round($dirSize, 2);
                        }
                        ?>
                        <canvas id="folderChart" width="400" height="400"></canvas>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const ctx = document.getElementById('folderChart').getContext('2d');
                                const folderChart = new Chart(ctx, {
                                    type: 'pie',
                                    data: {
                                        labels: <?php echo json_encode($dirLabels); ?>,
                                        datasets: [{
                                            label: 'Size in MB',
                                            data: <?php echo json_encode($dirData); ?>,
                                            backgroundColor: [
                                                'rgba(255, 99, 132, 0.2)',
                                                'rgba(54, 162, 235, 0.2)',
                                                'rgba(255, 206, 86, 0.2)',
                                                'rgba(75, 192, 192, 0.2)',
                                                'rgba(153, 102, 255, 0.2)',
                                                'rgba(255, 159, 64, 0.2)'
                                            ],
                                            borderColor: [
                                                'rgba(255, 99, 132, 1)',
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(255, 206, 86, 1)',
                                                'rgba(75, 192, 192, 1)',
                                                'rgba(153, 102, 255, 1)',
                                                'rgba(255, 159, 64, 1)'
                                            ],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        plugins: {
                                            legend: {
                                                position: 'top',
                                            },
                                            tooltip: {
                                                mode: 'index',
                                                intersect: false,
                                            }
                                        }
                                    }
                                });
                            });
                        </script>
                    </div>

                </div>
        </main>
    </div>
</div>