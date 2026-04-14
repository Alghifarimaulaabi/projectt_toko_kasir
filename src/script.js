document.addEventListener('DOMContentLoaded', function() {
    const logoutBtn = document.querySelector('a[href="../public/logout.php"]');
    const modal = document.getElementById('logoutModal');
    const cancelBtn = document.getElementById('cancelLogout');
    
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function(e) {
            e.preventDefault(); // Mencegah logout
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            modal.style.display = 'flex';
        });
    }
    
    // Tombol Batal
    if (cancelBtn) {
        cancelBtn.addEventListener('click', function() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            modal.style.display = 'none';
        });
    }
    
    // Klik di luar modal untuk menutup
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            modal.style.display = 'none';
        }
    });
    
    // Tombol ESC untuk menutup
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.classList.contains('flex')) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            modal.style.display = 'none';
        }
    });
});
