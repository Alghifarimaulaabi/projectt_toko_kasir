<?php
session_start();
require '../config/koneksi.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user) {
        if (password_verify($password, $user['password'])) {
    $_SESSION['email'] = $user['email'];
    $_SESSION['nama']  = $user['nama'];
    $_SESSION['toko']  = $user['toko'];

    header("Location: dashboard.php");
    exit;
} else {
            $error = "Password salah!";
        }
    } else {
        $error = "User tidak ditemukan!";
    }

    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>

<body class="min-h-screen flex items-center justify-center bg-[#6FCF97] font-poppins">

    <div class="bg-white p-8 shadow-lg rounded-2xl w-80 h-[400px]">
        
        <h2 class="text-2xl font-bold text-center mb-2 bg-gradient-to-r from-[#007a5c] to-[#6FCF97] bg-clip-text text-transparent leading-tight">Toko Kasir</h2>

        <div class="flex justify-center">
    <div class="w-64 h-10 bg-[#bdbdbd] rounded-full relative flex items-center p-1 mb-3.5">

        <!-- ACTIVE (Login) -->
        <div class="w-1/2 h-full bg-[#eee] rounded-full absolute top-0 left-0 z-10 border-2 border-[#007a5c]"></div>

        <!-- LOGIN -->
        <div class="w-1/2 flex justify-center items-center z-20 cursor-pointer">
            <i class="fa-solid fa-door-closed mr-2"></i>
            <h2 class="text-sm font-semibold">Login</h2>
        </div>

        <!-- REGISTER -->
        <div class="w-1/2 flex justify-center items-center z-20 cursor-pointer">
            <a href="register.php" class="flex">
            <i class="fa-solid fa-user-plus mr-2"></i>
            <h2 class="text-sm font-semibold">Register</h2>
        </a>
        </div>

    </div>
</div>

        <form method="POST" class="space-y-4">

            <!-- ERROR MESSAGE -->
            <?php if ($error): ?>
                <div class="bg-red-100 text-red-700 px-3 py-2 rounded-lg text-sm">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <!-- Username -->
            <div class="flex items-center border rounded-lg px-3 py-2">
                <i class="fa-solid fa-envelope text-gray-400 mr-2"></i>
                <input 
                    type="text" 
                    name="email" 
                    placeholder="Email"
                    class="w-full outline-none"
                    required
                >
            </div>

            <!-- Password -->
            <div class="flex items-center border rounded-lg px-3 py-2">
                <i class="fa-solid fa-lock text-gray-400 mr-2"></i>
                <input 
                    type="password" 
                    name="password" 
                    placeholder="Password" 
                    class="w-full outline-none"
                    required
                >
            </div>

            <!-- Button -->
            <button 
                type="submit" 
                class="w-full bg-[#007a5c] hover:bg-[#6FCF97] text-white py-2 rounded-lg transition
                6FCF97
                "
            >
                Login
            </button>

        </form>

        <div class="flex justify-center">
            <div class="d h-0.5 w-28 bg-gray-500 text-center mt-3.5"></div>
        </div>
        <!-- Register -->
        <p class="text-sm text-center mt-4">
            Belum punya akun? 
            <a href="register.php" class="text-blue-500 hover:underline">Register</a>
        </p>

    </div>

    <div class="w-72 h-72 fixed bottom-[-80px] right-[-120px] rounded-full bg-[#8adadc] opacity-70 -z-10"></div>

    <div class="w-72 h-72 fixed top-[-80px] left-[-120px] rounded-full bg-[#e0e1dd] opacity-70 -z-10"></div>

</body>
</html>