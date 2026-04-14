<!-- Modal Konfirmasi Logout -->
<div id="logoutModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all fade-up">
        <div class="p-6">
            <div class="flex justify-center mb-4">
                <div class="bg-red-100 rounded-full p-3">
                    <svg class="w-12 h-12 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-center text-gray-800 mb-2">Konfirmasi Logout</h3>
            <p class="text-gray-600 text-center mb-6">Apakah Anda yakin ingin keluar dari aplikasi?</p>
            <div class="flex gap-3">
                <button id="cancelLogout" class="flex-1 px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-semibold transition duration-200">
                    Batal
                </button>
                <a href="../public/logout.php" id="confirmLogout" class="flex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-semibold transition duration-200 text-center">
                    Logout
                </a>
            </div>
        </div>
    </div>
</div>
