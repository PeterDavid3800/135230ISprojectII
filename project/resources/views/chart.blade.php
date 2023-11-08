<x-layout>
    <!-- Include the Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div style="max-width: 400px; margin: 0 auto;">
        <!-- Add the canvas element to display the chart -->
        <canvas id="tagChart" width="200" height="200"></canvas>
    </div>

    <script>
        // Getting the canvas context
        var ctx = document.getElementById('tagChart').getContext('2d');

        // Getting the chart data from my PHP variable
        var chartData = @json($chartData);

        var tagChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: 'Best Deal Categories',
                    data: chartData.data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
            }
        });
    </script>
</x-layout>
