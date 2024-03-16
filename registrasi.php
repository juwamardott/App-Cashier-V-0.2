<?php

require './function.php';

if(isset($_POST['register'])){
     if(register($_POST) > 0){
          header("location:login.php");
     }else{
          mysqli_error($conn);
     }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Registration Form</title>
     <!-- Tambahkan link ke Tailwind CSS -->
     <link rel="stylesheet" href="./src/output.css">
     <style>
     @import url('https://fonts.googleapis.com/css2?family=Abel&family=Quicksand:wght@300..700&display=swap');
     </style>
</head>

<body
     class="bg-[url('../img/moon1.jpg')] bg-cover bg-center bg-no-repeat h-screen flex items-center justify-center overflow-hidden">
     <div class="max-w-md w-full bg-white bg-opacity-45 p-8 rounded shadow-md relative font-quicksand z-50">
          <h2 class="text-2xl font-semibold text-gray-800 mb-8 text-center">Registration</h2>
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
               <div>
                    <label for="confirm-password" class="block text-sm font-medium text-gray-700">Confirm
                         Password</label>
                    <input type="password" id="confirm-password" name="confirm-password"
                         class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md border-2 p-2">
               </div>
               <div>
                    <button type="submit" name="register" id="register"
                         class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                         Register
                    </button>
               </div>
          </form>
          <div id="pop-up-registrasi"
               class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden justify-center items-center">
               <div class="bg-white p-8 rounded-lg shadow-lg w-[30%]">
                    <div class="flex justify-center items-center mb-4">
                         <h2 class="text-2xl font-bold text-green-600">Success!!</h2>
                    </div>
                    <p class="text-lg text-gray-800 text-center">User Berhasil Ditambahkan.</p>
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
     const regis = document.querySelector('#register');
     const popup = document.querySelector('#pop-up-registrasi');
     regis.addEventListener('click', function() {
          <?php sleep(1); ?>
          popup.style.display = 'flex';
     })
     </script>
</body>

</html>