<x-layout>
    <!-- Include the Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div style="max-width: 400px; margin: 0 auto;">
        <!-- Add the canvas element to display the chart -->
        <canvas id="tagChart" width="200" height="200"></canvas>
        <!-- Add a button to export the data as CSV -->
        <button onclick="exportCSV()" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">Export this as CSV</button>
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
                    label: 'Most Ordered Deals',
                    data: chartData.data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {}
        });

        function exportCSV() {
            // Create a CSV string
            var csvContent = "data:text/csv;charset=utf-8,";
            csvContent += "Label,Data\n";
            
            chartData.labels.forEach((label, index) => {
                csvContent += `${label},${chartData.data[index]}\n`;
            });

            // Create a data URI and trigger a download
            var encodedUri = encodeURI(csvContent);
            var link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "chart_data.csv");
            document.body.appendChild(link);
            link.click();
        }
    </script>
</x-layout>
