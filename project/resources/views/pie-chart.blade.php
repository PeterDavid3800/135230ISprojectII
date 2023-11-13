<!-- resources/views/pie-chart.blade.php -->

<x-layout>
    <div style="max-width: 400px; margin: 0 auto;">
        <!-- Add the canvas element to display the pie chart -->
        <canvas id="categoryChart" width="400" height="400"></canvas>
    </div>
    <div style="text-align: center; margin-top: 20px;">
        <!-- Add a button to trigger CSV export -->
        <button onclick="exportToCSV()" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">Export to CSV</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Getting the canvas context
        var ctx = document.getElementById('categoryChart').getContext('2d');

        // Getting the chart data from the PHP variable passed to the view
        var categoriesArray = @json($categoriesArray);

        var categoryChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: Object.keys(categoriesArray),
                datasets: [{
                    data: Object.values(categoriesArray),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
        function exportToCSV() {
            // Convert categories data to CSV format
            const csvContent = "data:text/csv;charset=utf-8," + Object.keys(categoriesArray).join(",") + "\n" +
                Object.values(categoriesArray).join(",");

            // Create a download link
            const encodedUri = encodeURI(csvContent);
            const link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "categories_data.csv");

            // Trigger the download
            document.body.appendChild(link);
            link.click();
        }
    </script>
</x-layout>
