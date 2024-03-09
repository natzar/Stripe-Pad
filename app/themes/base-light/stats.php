
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class=" px-6 py-24 pb-8 sm:pt-16 sm:pb-16 lg:px-8 border-gray-800 border-b">
  <div class="mx-auto max-w-2xl text-center">
    <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl nunito">{Stats}</h1>
    <p class="mt-4 text-sm leading-8 text-gray-500">Database Statistics</p>
  </div>
</div>





 <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-white mb-4">Domain Database Statistics</h1>
        <!-- Statistics Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Total Domains -->
         
<? include dirname(__FILE__)."/../templates/stats.php"; ?>
    <div><canvas id="domainsChart"></canvas></div>
</div>
</div>
    <script>
        // Chart.js
        // var ctx = document.getElementById('domainsChart').getContext('2d');
        // var myChart = new Chart(ctx, {
        //     type: 'bar',
        //     data: {
        //         labels: ['Total Domains', '.com Domains', 'Domains with Technology'],
        //         datasets: [{
        //             label: 'Number of Domains',
        //             data: [500000, 300000, 150000],
        //             backgroundColor: [
        //                 'rgba(255, 99, 132, 0.2)',
        //                 'rgba(54, 162, 235, 0.2)',
        //                 'rgba(255, 206, 86, 0.2)'
        //             ],
        //             borderColor: [
        //                 'rgba(255, 99, 132, 1)',
        //                 'rgba(54, 162, 235, 1)',
        //                 'rgba(255, 206, 86, 1)'
        //             ],
        //             borderWidth: 1
        //         }]
        //     },
        //     options: {
        //         scales: {
        //             y: {
        //                 beginAtZero: true
        //             }
        //         }
        //     }
        // });
    </script>
