<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}


?>

<?php require_once '../view/layouts/header.php'?>

<!-- nama halaman -->
<?php $title = "Dashboard"; ?>


<?php require_once '../view/layouts/sidebar.php'?>

<div class="flex gap-4 ml-64 justify-center ">
    <div class="w w-80 h-28 p-3 rounded-2xl bg-white">
        <h3>Profit</h3>
    </div>
    <div class="w w-80 h-28 p-3 rounded-2xl bg-white">
        <h3>Profit</h3>
    </div>
    <div class="w w-80 h-28 p-3 rounded-2xl bg-white">
        <h3>Profit</h3>
    </div>
</div>

<div class="ml-64 p-6">
    <h1 class="text-2xl font-bold mb-6">Dashboard</h1>

    <div class="flex gap-4 overflow-auto flex-col lg:flex-row">
        
        <!-- Chart Barang Terlaris -->
    <div class="bg-white p-4 rounded-xl shadow flex-1">
            <h2 class="text-lg font-semibold mb-4">Barang Terlaris</h2>
            <div class="h-auto" class="flex justify-center">
                <canvas id="chartTerlaris"></canvas>
            </div>
        </div>

        <!-- Chart Penjualan -->
        <div class="bg-white p-4 rounded-xl shadow flex-1">
            <h2 class="text-lg font-semibold mb-4">Grafik Penjualan</h2>
            <div class="h-auto flex justify-center">
                <canvas id="chartPenjualan" class=""></canvas>
            </div>
        </div>

    </div>
</div>
<?php require_once '../view/layouts/cLogout.php'?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
function loadChart() {
    fetch('ajax_penjualan.php?action=getProdukTerlaris')
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                const labels = res.data.map(item => item.nama_produk);
                const data = res.data.map(item => item.total_terjual);

                const ctx = document.getElementById('chartTerlaris');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Terjual',
                            data: data,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        });
}

function loadChartPenjualan() {
    fetch('ajax_penjualan.php?action=getPenjualanHarian')
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                const labels = res.data.map(item => item.tgl);
                const data = res.data.map(item => item.total_penjualan);

                const ctx = document.getElementById('chartPenjualan');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total Penjualan',
                            data: data,
                            fill: true,
                            tension: 0.3,
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: true }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        });
}

document.addEventListener('DOMContentLoaded', loadChartPenjualan);

document.addEventListener('DOMContentLoaded', loadChart);
</script>
<?php require_once '../view/layouts/footer.php'?>