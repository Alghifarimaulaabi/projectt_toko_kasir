<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    
    <style>
        .fade-up {
            animation: fadeUp 0.8s ease-out;
        }
        
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        html {
            scroll-behavior: smooth;
        }
        
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #2FA084;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #1F6F5F;
        }
    </style>
</head>

<body class="bg-gray-100">

<nav class="bg-[#1F6F5F] text-white px-4 sm:px-6 py-4 flex justify-between items-center fixed top-0 w-full z-50 shadow-md">
    <!-- Logo -->
    <div class="font-bold text-base sm:text-xl">
        Toko Kasir
    </div>

    <ul class="hidden md:flex items-center gap-4 lg:gap-6">
        <li><a href="#" class="hover:text-gray-200 transition text-sm lg:text-base">Home</a></li>
        <li><a href="#tentang" class="hover:text-gray-200 transition text-sm lg:text-base">Tentang</a></li>
        <li><a href="#fitur" class="hover:text-gray-200 transition text-sm lg:text-base">Fitur</a></li>
        <li>
            <a href="login.php" class="bg-white text-[#1F6F5F] px-3 py-1.5 lg:px-4 rounded hover:bg-gray-200 transition text-sm lg:text-base">
                Login
            </a>
        </li>
    </ul>
    
    <div class="md:hidden">
        <button id="mobile-menu-btn" class="text-white focus:outline-none">
            <i class="fas fa-bars text-xl"></i>
        </button>
    </div>
</nav>

<div id="mobile-menu" class="hidden md:hidden fixed top-16 left-0 w-full bg-[#1F6F5F] z-40 shadow-lg">
    <ul class="flex flex-col items-center py-4 gap-3">
        <li><a href="#" class="text-white hover:text-gray-200 transition py-2 px-4 block">Home</a></li>
        <li><a href="#tentang" class="text-white hover:text-gray-200 transition py-2 px-4 block">Tentang</a></li>
        <li><a href="#fitur" class="text-white hover:text-gray-200 transition py-2 px-4 block">Fitur</a></li>
        <li>
            <a href="login.php" class="bg-white text-[#1F6F5F] px-6 py-2 rounded hover:bg-gray-200 transition inline-block">
                Login
            </a>
        </li>
    </ul>
</div>

<header class="fade-up pt-20 sm:pt-24 pb-12 sm:pb-16 px-4 sm:px-6">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-8 md:gap-10">
        <!-- LEFT -->
        <div class="md:w-1/2 text-center md:text-left px-2 sm:px-0">
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold bg-gradient-to-r from-[#2FA084] to-[#6FCF97] bg-clip-text text-transparent leading-tight">
                Web Toko Kasir Untuk Usaha Anda
            </h1>

            <p class="text-gray-600 mt-3 sm:mt-4 text-sm sm:text-base">
                Kelola penjualan, produk, dan transaksi dengan mudah menggunakan sistem kasir modern yang cepat dan efisien.
            </p>

            <div class="flex justify-center md:justify-start gap-3 mt-5 sm:mt-6">
                <a href="login.php">
                    <button class="bg-gradient-to-r from-[#2FA084] to-[#6FCF97] text-white px-4 sm:px-6 py-2 sm:py-2.5 rounded-lg font-semibold hover:shadow-lg transition text-sm sm:text-base">
                        Get Start
                    </button>
                </a>
                <button class="border-2 border-[#2FA084] text-[#2FA084] px-4 sm:px-6 py-2 sm:py-2.5 rounded-lg font-semibold bg-white hover:bg-[#2FA084] hover:text-white transition text-sm sm:text-base">
                    Pelajari
                </button>
            </div>
            
            <div class="flex flex-wrap justify-center md:justify-start gap-3 sm:gap-4 items-center mt-4 italic text-gray-500 text-xs sm:text-sm">
                <div class="flex items-center gap-1">
                    <i class="fa-solid fa-user-check"></i>
                    <p>50k Pengguna Aktif</p>
                </div>
                <div class="flex items-center gap-1">
                    <i class="fa-solid fa-store"></i>
                    <p>500 UMKM Terbantu</p>
                </div>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="md:w-1/2 flex justify-center px-4">
            <img src="img/bg1.jpeg" 
                 alt="Kasir App"
                 class="w-full max-w-[280px] sm:max-w-sm h-48 sm:h-56 md:h-64 object-cover rounded-2xl shadow-lg transform hover:scale-105 transition duration-300">
        </div>
    </div>
</header>

<div class="fade-up w-full bg-[#2FA084]/60 relative z-10 flex flex-wrap justify-center items-center gap-3 sm:gap-4 md:gap-6 text-white px-3 sm:px-6 md:px-8 py-5 sm:py-6 md:py-8 mt-5">
    <!-- Card 1 -->
    <div class="flex flex-row items-center bg-white/20 backdrop-blur-sm rounded-full px-3 py-1.5 sm:px-4 sm:py-2 md:px-5 md:py-2.5">
        <div class="w-7 h-7 sm:w-8 sm:h-8 md:w-10 md:h-10 bg-red-400 rounded-full flex justify-center items-center mr-2 sm:mr-3">
            <i class="fa-solid fa-cart-shopping text-[10px] sm:text-[12px] md:text-[14px]"></i>
        </div>
        <p class="text-xs sm:text-sm md:text-base whitespace-nowrap">Mempermudah Pembelian</p>
    </div>
    
    <!-- Card 2 -->
    <div class="flex flex-row items-center bg-white/20 backdrop-blur-sm rounded-full px-3 py-1.5 sm:px-4 sm:py-2 md:px-5 md:py-2.5">
        <div class="w-7 h-7 sm:w-8 sm:h-8 md:w-10 md:h-10 bg-orange-300 rounded-full flex justify-center items-center mr-2 sm:mr-3">
            <i class="fa-solid fa-chart-line text-[10px] sm:text-[12px] md:text-[14px]"></i>
        </div>
        <p class="text-xs sm:text-sm md:text-base whitespace-nowrap">Laporan Akurat</p>
    </div>
    
    <!-- Card 3 -->
    <div class="flex flex-row items-center bg-white/20 backdrop-blur-sm rounded-full px-3 py-1.5 sm:px-4 sm:py-2 md:px-5 md:py-2.5">
        <div class="w-7 h-7 sm:w-8 sm:h-8 md:w-10 md:h-10 bg-blue-200 rounded-full flex justify-center items-center mr-2 sm:mr-3">
            <i class="fa-solid fa-clock text-[10px] sm:text-[12px] md:text-[14px]"></i>
        </div>
        <p class="text-xs sm:text-sm md:text-base whitespace-nowrap">Proses Cepat</p>
    </div>
</div>

<div class="tentang px-4 sm:px-6" id="tentang">
    <div class="text-center mb-6 sm:mb-8 mt-8 sm:mt-10">
        <h1 class="font-bold text-2xl sm:text-3xl bg-gradient-to-r from-[#2FA084] to-[#6FCF97] bg-clip-text text-transparent leading-tight border-b-2 border-[#2FA084] pb-2 inline-block">
            Tentang Kami
        </h1>
    </div>

    <div class="max-w-6xl mx-auto flex flex-col items-center gap-6 text-center px-2">
        <p class="text-sm sm:text-base text-gray-700 leading-relaxed">
            Kami hadir untuk membantu UMKM dalam mengelola bisnis mereka dengan sistem kasir yang modern, mudah digunakan, dan terjangkau. Dengan pengalaman melayani ratusan toko di Indonesia, kami memahami kebutuhan bisnis Anda.
        </p>
    </div>
    
    <!-- <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-5 p-4 sm:p-5 max-w-6xl mx-auto">
        <img src="img/bg1.jpeg" class="w-full rounded-2xl hover:scale-105 transition duration-300 object-cover h-48 sm:h-56 md:h-64 shadow-lg" alt="">
        <img src="img/bg1.jpeg" class="w-full rounded-2xl hover:scale-105 transition duration-300 object-cover h-48 sm:h-56 md:h-64 shadow-lg" alt="">
        <img src="img/bg1.jpeg" class="w-full rounded-2xl hover:scale-105 transition duration-300 object-cover h-48 sm:h-56 md:h-64 shadow-lg" alt="">
    </div> -->
</div>

    <!-- feature -->
<div class="px-4 sm:px-6" id="fitur">
    <div class="text-center mb-6 sm:mb-8 mt-12 sm:mt-16">
        <h1 class="font-bold text-2xl sm:text-3xl bg-gradient-to-r from-[#2FA084] to-[#6FCF97] bg-clip-text text-transparent leading-tight border-b-2 border-[#2FA084] pb-2 inline-block">
            Fitur Tersedia
        </h1>
    </div>

    <!-- Feature 1 -->
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-6 md:gap-10 mb-12 md:mb-16">
        <div class="md:w-1/2">
            <p class="text-sm sm:text-base text-gray-700 leading-relaxed text-center md:text-left">
                <span class="font-bold text-[#2FA084] text-base sm:text-lg">✓ Manajemen Produk</span><br>
                Kelola stok barang dengan mudah, tambah produk baru, update harga, dan pantau ketersediaan barang secara real-time.
            </p>
        </div>
        <div class="md:w-1/2 flex justify-center">
            <img src="img/manajemen.png" class="w-full max-w-[300px] sm:max-w-sm rounded-2xl hover:scale-105 transition duration-300 shadow-lg h-48 sm:h-56 object-cover" alt="">
        </div>
    </div>

    <!-- Feature 2 -->
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-6 md:gap-10 mb-12 md:mb-16">
        <div class="md:w-1/2 order-2 md:order-1 flex justify-center">
            <img src="img/grafik.png" class="w-full max-w-[300px] sm:max-w-sm rounded-2xl hover:scale-105 transition duration-300 shadow-lg h-48 sm:h-56 object-cover" alt="">
        </div>
        <div class="md:w-1/2 order-1 md:order-2">
            <p class="text-sm sm:text-base text-gray-700 leading-relaxed text-center md:text-left">
                <span class="font-bold text-[#2FA084] text-base sm:text-lg">✓ Transaksi Cepat</span><br>
                Proses checkout super cepat dengan tampilan yang intuitif. Dukung berbagai metode pembayaran tunai, QRIS, dan transfer bank.
            </p>
        </div>
    </div>

    <!-- Feature 3 -->
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-6 md:gap-10">
        <div class="md:w-1/2">
            <p class="text-sm sm:text-base text-gray-700 leading-relaxed text-center md:text-left">
                <span class="font-bold text-[#2FA084] text-base sm:text-lg">✓ Laporan Lengkap</span><br>
                Lihat laporan penjualan harian, mingguan, dan bulanan. Analisis keuntungan dan buat keputusan bisnis yang lebih baik.
            </p>
        </div>
        <div class="md:w-1/2 flex justify-center">
            <img src="img/riwayat.png" class="w-full max-w-[300px] sm:max-w-sm rounded-2xl hover:scale-105 transition duration-300 shadow-lg h-48 sm:h-56 object-cover" alt="">
        </div>
    </div>
</div>

<!-- Footer - Responsive dengan Tailwind Grid -->
<footer class="bg-gradient-to-r from-[#1F6F5F] to-[#2FA084] text-white p-6 sm:p-8 mt-12 sm:mt-16">
    <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 sm:gap-8">
        
        <div class="text-center sm:text-left">
            <h2 class="text-lg sm:text-xl font-bold mb-2">Kasir App</h2>
            <p class="text-xs sm:text-sm">Aplikasi kasir sederhana untuk UMKM.</p>
        </div>

        <div class="text-center sm:text-left">
            <h2 class="text-lg sm:text-xl font-bold mb-2">Menu</h2>
            <ul class="text-xs sm:text-sm space-y-1">
                <li><a href="#" class="hover:text-gray-200 transition">Home</a></li>
                <li><a href="#tentang" class="hover:text-gray-200 transition">Tentang</a></li>
                <li><a href="#fitur" class="hover:text-gray-200 transition">Fitur</a></li>
            </ul>
        </div>

        <div class="text-center sm:text-left">
            <h2 class="text-lg sm:text-xl font-bold mb-2">Kontak</h2>
            <p class="text-xs sm:text-sm break-words">Email: alghifarimaulaabi@gmail.com</p>
            <p class="text-xs sm:text-sm">WA: 083830104299</p>
        </div>
    </div>

    <div class="text-center text-xs sm:text-sm mt-6 sm:mt-8 pt-4 border-t border-white/20">
        © 2026 Kasir App | All Rights Reserved
    </div>
</footer>

<!-- DECORATION -->
<div class="w-48 h-48 sm:w-64 sm:h-64 md:w-72 md:h-72 fixed bottom-[-60px] right-[-60px] sm:bottom-[-80px] sm:right-[-100px] md:right-[-120px] rounded-full bg-amber-400 opacity-60 -z-10"></div>

<!-- JavaScript untuk Mobile Menu -->
<script>
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }
    
    // Close mobile menu ketika klik link
    const mobileLinks = mobileMenu?.querySelectorAll('a');
    mobileLinks?.forEach(link => {
        link.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
        });
    });
</script>

</body>
</html>