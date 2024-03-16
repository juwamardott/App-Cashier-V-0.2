<?php
session_start();
require './function.php';
// cek cookie
if(isset($_COOKIE['id_user']) && isset($_COOKIE['key'])){
     $id = $_COOKIE['id_user'];
     $key = $_COOKIE['key'];

     // ambil username
     $hasil = mysqli_query($conn, "SELECT username FROM tb_user WHERE id_user= '$id'");
     $row = mysqli_fetch_assoc($hasil);

     if($key === hash('sha256', $row['username'])){
          $_SESSION['login'] = true;
     }
    
}
if(isset($_SESSION['login'])){
     header('location:index.php');
     exit;
}
if(isset($_POST['button-login'])){
     $username = $_POST['username'];
     $password = $_POST['password'];

     $result = mysqli_query($conn,"SELECT * FROM tb_user WHERE username = '$username'");

     // cek username
     if(mysqli_num_rows($result) === 1){
          // cek password
          $row = mysqli_fetch_assoc($result);
          if(password_verify($password,$row['password'])){
          
               // set sesion
               $_SESSION['login'] = true;
               $_SESSION['nama'] = $username;
               

               // cek remember me
               if(isset($_POST['remember_me'])){
                    // setcookie('login','true', time()+60);
                    setcookie('id_user', $row['id_user'], time()+60);
                    setcookie('key', hash('sha256',$row['username']), time()+60);
               }
               
               header('location:index.php');
               exit;
          }
          
     }
     $error = true;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Login</title>
     <link rel="stylesheet" href="./src/output.css">
     <style>
     @import url('https://fonts.googleapis.com/css2?family=Abel&family=Quicksand:wght@300..700&display=swap');
     </style>
</head>

<body
     class="bg-[url('../img/moon1.jpg')] bg-cover bg-center bg-no-repeat h-screen flex items-center justify-center overflow-hidden">
     <div class="max-w-md w-full bg-white bg-opacity-45 p-8 rounded shadow-md font-quicksand relative z-50">
          <h2 class="text-2xl font-semibold text-gray-800 mb-8 text-center">Login</h2>
          <?php if(isset($error)): ?>
          <div class="absolute right-0 left-0 mx-auto top-16 bottom-0 w-[90%] h-auto">
               <h1 class="text-red-500 font-semibold text-center">Username dan Password Salah !!!</h1>
          </div>
          <?php endif;?>

          <form action="" method="POST" class="space-y-4">
               <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" id="username" name="username"
                         class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md border-2 p-2">
               </div>
               <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password"
                         class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md border-2 p-2">
               </div>
               <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                         <input type="checkbox" id="remember_me" name="remember_me"
                              class="h-4 w-4 text-blue-500 focus:ring-blue-400 border-gray-300 rounded">
                         <label for="remember_me" class="ml-2 block text-sm text-gray-900">Remember me</label>
                    </div>
                    <div>
                         <a href="registrasi.php" class="text-sm text-blue-600 hover:underline">belum punya akun?</a>
                    </div>
               </div>
               <div>
                    <button type="submit" name="button-login" id="button-login"
                         class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                         Sign in
                    </button>
               </div>
          </form>
          <div id="pop-up-login" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden justify-center items-center">
               <div class="bg-white p-8 rounded-lg shadow-lg w-[30%]">
                    <div class="flex justify-center items-center mb-4">
                         <h2 class="text-2xl font-bold text-green-600">Success!!</h2>
                    </div>
                    <p class="text-lg text-gray-800 text-center">Berhasil di Submit.</p>
                    <div class="mt-6 flex justify-center animate-bounce">
                         <img src="./icon/checklist.png" alt="Checkmark" class="w-12 h-12">
                    </div>
               </div>
          </div>
     </div>
     <div class="absolute top-0 left-0 bottom-0 w-[40%] h-[70%]  animate-spin-slow ">
          <img src="./icon/jet-plane.png" alt="" class="w-14 absolute -top-36 left-36 rotate-[60deg]">
          <img src="./icon/travelling.png" alt="" class="w-14">
          <img src="./icon/fire.png" alt="" class="w-8 top-10 -left-3 rotate-[210deg] animate-pulse absolute">
     </div>
     <div class="absolute right-0 bottom-0 w-[40%] h-[70%] animate-spin-slow-2">
          <img src="./icon/jet-plane.png" alt="" class="w-14 absolute -top-48 left-44 rotate-[70deg]">
          <img src="./icon/jet.png" alt="" class="w-14">
          <img src="./icon/fire.png" alt="" class="w-8 top-10 -left-3 rotate-[210deg] animate-pulse absolute">
     </div>
     <script>
     const btn = document.querySelector('#button-login');
     const popup = document.querySelector('#pop-up-login');
     btn.addEventListener('click', function() {
          <?php sleep(1); ?>
          popup.style.display = 'flex';
     })
     </script>
</body>

</html>