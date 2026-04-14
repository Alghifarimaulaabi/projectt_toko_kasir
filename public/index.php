<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir App</title>
    <link rel="stylesheet" href="output.css">
    <!-- link cdn icon fontawesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>

<body class="bg-gray-100">

<!-- NAVBAR -->
<nav class="bg-[#1F6F5F] text-white px-6 py-4 flex justify-between items-center fixed top-0 w-full z-50 shadow-md">

    <!-- Logo -->
    <div class="font-bold text-xl">
        Toko Kasir
    </div>

    <!-- Menu -->
    <ul class="hidden md:flex items-center gap-6">
        <li><a href="#" class="hover:text-gray-200 transition">Home</a></li>
        <li><a href="#" class="hover:text-gray-200 transition">Produk</a></li>
        <li>
            <a href="login.php" class="bg-white text-[#1F6F5F] px-4 py-1.5 rounded hover:bg-gray-200 transition">
                Login
            </a>
        </li>
    </ul>

</nav>

<!-- HEADER -->
<header class=" fade-up pt-28 pb-16 px-6 font-poppins">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-10">

        <!-- LEFT -->
        <div class="md:w-1/2 text-center md:text-left">
            <h1 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-[#2FA084] to-[#6FCF97] bg-clip-text text-transparent leading-tight">
                Web Toko Kasir Untuk Usaha Anda
            </h1>

            <p class="text-gray-600 mt-4">
                Kelola penjualan, produk, dan transaksi dengan mudah menggunakan sistem kasir modern yang cepat dan efisien.
            </p>

            <div class="flex justify-center md:justify-start gap-3 mt-6">
                <a href="login.php">
                    <button class="btn btn-primary">Get Start</button>
            </a>
                <button class="btn btn-outline">Pelajari</button>
            </div>
            <div class="u flex gap-2 items-center mt-3 italic ml-0.5 text-gray-500">
                <i class="fa-solid fa-user-check"></i>
                <p>50k Penguna Aktif</p>

                <i class="fa-solid fa-user-check ml-2.5"></i>
                <p class="">500 UMKM Terbantu</p>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="md:w-1/2 flex justify-center">
            <img src="img/bg1.jpeg" 
                 alt="Kasir App"
                 class="w-full max-w-sm h-64 object-cover rounded-2xl shadow-lg transform hover:scale-105 transition duration-300">
        </div>

    </div>
</header>

    <!-- information -->
<div class="fade-up w-full h-44 bg-[#2FA084]/60 relative z-10 flex items-center justify-between text-white px-16 mt-5">
    <!-- col -->
    <div class="flex flex-row">
        <div class="w w-10 p-1 bg-red-400 rounded-full flex justify-center items-center mr-2">
            <i class="fa-solid fa-check text-[14px]"></i>
        </div>
        <p>Mempermudah Pembelian</p>
    </div>
    <div class="flex flex-row">
        <div class="w w-10 p-1 bg-orange-300 rounded-full flex justify-center items-center mr-2">
            <i class="fa-solid fa-check text-[14px]"></i>
        </div>
        <p>Mempermudah Pembelian</p>
    </div>
    <div class="flex flex-row">
        <div class="w w-10 p-1 bg-blue-200 rounded-full flex justify-center items-center mr-2">
            <i class="fa-solid fa-check text-[14px]"></i>
        </div>
        <p>Mempermudah Pembelian</p>
    </div>
</div>

<!-- Tentang Saya -->
 <div class="tentang">
    <div class="text-center mb-5">
    <h1 class="font-bol text-3xl font-bold mt-6 font-poppins bg-gradient-to-r from-[#2FA084] to-[#6FCF97] bg-clip-text text-transparent leading-tight border-b-2 border-[#2FA084] pb-2 inline-block">Tentang Kami</h1>
    </div>

    <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-10 text-center">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur qui laboriosam voluptas commodi explicabo, fuga, voluptatem tempore quam cupiditate aliquam necessitatibus ipsum reiciendis? Tempora id labore aperiam quia quo mollitia.</p>
    </div>
    <div class="flex p-5 justify-center gap-5">
            <img src="img/bg1.jpeg" class="w-1/4 rounded-2xl" alt="">
            <img src="img/bg1.jpeg" class="w-1/4 rounded-2xl" alt="">
            <img src="img/bg1.jpeg" class="w-1/4 rounded-2xl" alt="">
        </div>
 </div>

<!-- feature -->
 <div class="text-center">
 <div class="fitur">
    <h1 class="font-bol text-3xl font-bold mt-6 font-poppins bg-gradient-to-r from-[#2FA084] to-[#6FCF97] bg-clip-text text-transparent leading-tight border-b-2 border-[#2FA084] pb-2 inline-block">Fitur Tersedia</h1>
    </div>

    <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-10">
      

        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur qui laboriosam voluptas commodi explicabo, fuga, voluptatem tempore quam cupiditate aliquam necessitatibus ipsum reiciendis? Tempora id labore aperiam quia quo mollitia.</p>
        <img src="img/bg1.jpeg" class="f w-1/3 rounded-2xl hover:scale-110 transition duration-300" alt="">
    </div>
 </div>

    <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-10 mt-10">
        <img src="img/bg1.jpeg" class="f w-1/3 rounded-2xl hover:scale-110 transition duration-300" alt="">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur qui laboriosam voluptas commodi explicabo, fuga, voluptatem tempore quam cupiditate aliquam necessitatibus ipsum reiciendis? Tempora id labore aperiam quia quo mollitia.</p>
    </div>
 </div>

    <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-10 mt-10">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur qui laboriosam voluptas commodi explicabo, fuga, voluptatem tempore quam cupiditate aliquam necessitatibus ipsum reiciendis? Tempora id labore aperiam quia quo mollitia.</p>
        <img src="img/bg1.jpeg" class="f w-1/3 rounded-2xl hover:scale-110 transition duration-300" alt="">
    </div>
 </div>
  


<!-- DECORATION -->
<div class="w-72 h-72 fixed bottom-[-80px] right-[-120px] rounded-full bg-amber-400 opacity-70 -z-10"></div>


</body>
</html>