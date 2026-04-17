<div class="c flex">
    <!-- sidebar -->
    <div class="s w-3xs h-full fixed bg-go shadow-lg">
        <div class="p-4 border-b border-white/20">
            <h2 class="text-white font-poppins font-semibold text-xl text-center">
                Toko <?= $_SESSION['toko'] ?? 'Toko Saya' ?>
            </h2>
        </div>

        <ul class="flex flex-col mt-4 px-3 gap-3.5">
            <a href="dashboard.php">
                <li class="mx-auto w-12 h-auto p-2 bg-gradient-to-r from-[#2FA084] to-[#6FCF97] rounded-2xl hover:scale-105 transition duration-300 md:w-full bg-gl border border-white">
                    <div class="flex items-center gap-3">
                        <svg class="text-white w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="text-white">Home</span>
                    </div>
                </li>
            </a>
            <a href="penjualan.php">
                <li class="mx-auto w-12 h-auto p-2 bg-gradient-to-r from-[#2FA084] to-[#6FCF97] rounded-2xl hover:scale-105 transition duration-300 md:w-full bg-gl border border-white">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 1.5M17 13l1.5 1.5M9 21a1 1 0 100-2 1 1 0 000 2zm8 0a1 1 0 100-2 1 1 0 000 2z" />
                        </svg>
                        <span class="text-white">Penjualan</span>
                    </div>
                </li>
            </a>
            <a href="produk.php">
                <li class="mx-auto w-12 h-auto p-2 bg-gradient-to-r from-[#2FA084] to-[#6FCF97] rounded-2xl hover:scale-105 transition duration-300 md:w-full bg-gl border border-white">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-white transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7L4 7M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16m8 0H8m8 0h2a2 2 0 002-2V9a2 2 0 00-2-2h-2m-8 0H6a2 2 0 00-2 2v10a2 2 0 002 2h2"></path>
                        </svg>
                        <span class="text-white">Produk</span>
                    </div>
                </li>
            </a>
            <a href="riwayat.php">
                <li class="mx-auto w-12 h-auto p-2 bg-gradient-to-r from-[#2FA084] to-[#6FCF97] rounded-2xl hover:scale-105 transition duration-300 md:w-full bg-gl border border-white">
                    <div class="flex items-center gap-3">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-white transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-white">Riwayat</span>
                    </div>
                </li>
            </a>
        </ul>

        <a href="../public/logout.php" class="absolute bottom-4 left-4 right-4">
            <div class="flex items-center gap-3 px-4 py-2 rounded-lg bg-red-500 hover:bg-red-500/50 transition-all duration-300 group">
                <svg class="w-5 h-5 text-white transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                <span class="text-white font-medium">Logout</span>
            </div>
        </a>
    </div>
</div>

<style>
    /* Khusus HP: sembunyikan teks, perkecil lebar sidebar */
    @media (max-width: 768px) {
        /* Sembunyikan semua teks di sidebar */
        .s ul span,
        .s .absolute span {
            display: none !important;
        }
        
        /* Perkecil lebar sidebar jadi hanya cukup untuk icon */
        .s {
            width: 70px !important;
        }
        
        /* Pusatkan icon di tengah */
        .s ul .flex {
            justify-content: center !important;
        }
        
        /* Hapus gap agar icon lebih rapat */
        .s ul .flex {
            gap: 0 !important;
        }
        
        /* Sesuaikan padding */
        .s ul {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
        
        /* Tombol logout di mobile */
        .s .absolute {
            left: 0 !important;
            right: 0 !important;
            display: flex !important;
            justify-content: center !important;
        }
        
        .s .absolute div {
            justify-content: center !important;
        }
        
        /* Header toko sembunyikan di HP */
        .s .border-b {
            display: none !important;
        }
        
        /* Geser konten utama ke kanan karena sidebar mengecil */
        .ml-64 {
            margin-left: 70px !important;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const logoutBtn = document.querySelector('a[href="../public/logout.php"]');
        const modal = document.getElementById('logoutModal');
        const cancelBtn = document.getElementById('cancelLogout');
        
        if (logoutBtn) {
            logoutBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (modal) {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    modal.style.display = 'flex';
                }
            });
        }
        
        if (cancelBtn && modal) {
            cancelBtn.addEventListener('click', function() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                modal.style.display = 'none';
            });
        }
        
        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    modal.style.display = 'none';
                }
            });
        }
        
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal && modal.classList.contains('flex')) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                modal.style.display = 'none';
            }
        });
    });
</script>