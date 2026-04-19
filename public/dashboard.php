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

<div class="flex">

    <!-- SIDEBAR -->
    <?php require_once '../view/layouts/sidebar.php'?>

    <!-- CONTENT -->
    <div class="ml-64 w-full p-4 overflow-y-auto">

    <h1 class="f font-bold text-4xl text-[#1a1a1a] mb-2 md:hidden">
        Toko <?= $_SESSION['toko'] ?? 'Toko Saya' ?>
    </h1>
        <h1 class="font-bold mb-6 text-gray-800 text-lg md:text-2xl">
            Dashboard
        </h1>
        

        <!-- CARD -->
        <div class="flex gap-6 justify-center flex-wrap mb-6">
            
            <!-- Profit -->
            <div class="group flex-1 h-28 p-4 rounded-xl bg-white shadow-md hover:shadow-xl hover:scale-100 transition-all duration-300 border-l-8 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-gray-500 text-sm font-semibold uppercase tracking-wide">Profit</h3>
                        <p id="profit" class="text-2xl font-bold text-gray-800 mt-1">Rp 0</p>
                    </div>
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                </div>
            </div>


        </div>

        <!-- CHART -->
        <div class="flex gap-4 flex-col lg:flex-row">

            <!-- Barang Terlaris -->
            <div class="bg-white p-4 rounded-xl shadow-md flex-1">
                <h2 class="text-lg font-semibold mb-4 text-gray-700">Barang Terlaris</h2>
                <div class="flex justify-center">
                    <canvas id="chartTerlaris"></canvas>
                </div>
            </div>

            <!-- Penjualan -->
            <div class="bg-white p-4 rounded-xl shadow-md flex-1">
                <h2 class="text-lg font-semibold mb-4 text-gray-700">Grafik Penjualan</h2>
                <div class="flex justify-center">
                    <canvas id="chartPenjualan"></canvas>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="tambahan"></div>


<?php require_once '../view/layouts/cLogout.php'?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
function loadDashboard() {
    fetch('ajax_penjualan.php?action=getDashboardSummary')
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                document.getElementById('profit').innerText =
                    'Rp ' + Number(res.data.profit).toLocaleString();

                document.getElementById('pengeluaran').innerText =
                    'Rp ' + Number(res.data.pengeluaran).toLocaleString();

                document.getElementById('transaksi').innerText =
                    res.data.transaksi;
            }
        });
}

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
                            y: { beginAtZero: true }
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
                        scales: {
                            y: { beginAtZero: true }
                        }
                    }
                });
            }
        });
}

document.addEventListener('DOMContentLoaded', () => {
    loadDashboard();
    loadChart();
    loadChartPenjualan();
});


</script>

<?php require_once '../view/layouts/footer.php'?>