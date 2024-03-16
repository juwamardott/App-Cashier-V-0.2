<?php
session_start();
if(!isset($_SESSION['login'])){
     header("location:login.php");
     exit;
}
require 'function.php';

$id = "";
$id = $_GET['id'];
$result = mysqli_query($conn,"SELECT * FROM tb_all_transaksi WHERE id_all_transaksi = $id");
$update = mysqli_fetch_assoc($result);

if(isset($_POST['submit'])){
     if( updateBarang($_POST, $id) > 0 ){
          header("Location:data_barang.php");
     }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Update Transaksi</title>
     <link rel="stylesheet" href="./src/output.css">
     <style>
     @import url('https://fonts.googleapis.com/css2?family=Abel&family=Quicksand:wght@300..700&display=swap');
     </style>
</head>

<body class="">
     <section id="">
          <div class="w-full flex justify-between relative font-quicksand font-semibold">
               <!-- Sidebar -->
               <div class="h-svh w-[20%] overflow-auto bg-hero-0">
                    <div class="w-[90%] mx-auto  border-2 my-5 rounded-sm shadow-md">
                         <img src="./img/logo-toko.png" alt="" class="w-32 mx-auto">
                    </div>
                    <hr>
                    <div
                         class="w-[90%] mx-auto flex justify-center gap-2 items-center  mt-5 px-2 py-1 rounded-md bg-putih-0 bg-opacity-35 shadow-md">
                         <img src="./icon/profile.png" alt="" class="w-10 rounded-[100%]">
                         <h1 class="text-sm text-white"><?= $_SESSION['nama']?></h1>
                    </div>
                    <div class="w-[90%] h-svh mx-auto mt-5 rounded-md">
                         <div class="rounded-md w-[98%] h-svh mx-auto my-5 text-base text-white">
                              <ul class="p-3 gap-4 grid">
                                   <li
                                        class="hover:scale-105 transition-all ease-out duration-700 p-2 bg-putih-0 hover:bg-gray-200 bg-opacity-35 rounded-sm  shadow-md">
                                        <a href="index.php">Beranda</a>
                                   </li>
                                   <li
                                        class="hover:scale-105 transition-all ease-out duration-700 p-2 bg-putih-0 hover:bg-gray-200 bg-opacity-35 rounded-sm  shadow-md">
                                        <a href=" data_barang.php">Data Barang</a>
                                   </li>
                                   <li
                                        class="hover:scale-105 transition-all ease-out duration-700 p-2 bg-putih-0 hover:bg-gray-200 bg-opacity-35 rounded-sm  shadow-md">
                                        <a href="data_transaksi.php">Data Transaksi</a>
                                   </li>
                                   <li
                                        class="hover:scale-105 transition-all ease-out duration-700 p-2 bg-putih-0 hover:bg-gray-200 bg-opacity-35 rounded-sm  shadow-md">
                                        <a href="kasir.php">Catat Transaksi</a>
                                   </li>
                              </ul>
                              <hr>
                              <div class="w-[90%] border-2 rounded-md mx-auto text-center mt-5 bg-red-400">
                                   <a href="logout.php" id="logout" class="p-2  inline-block uppercase">Logout</a>
                              </div>
                         </div>
                    </div>
               </div>
               <!-- End Side Bar -->
               <!-- Content -->
               <div class="border  h-svh w-[79%] overflow-auto flex justify-evenly gap-5 pt-2 bg-putih-0">
                    <div class="py-20">
                         <form action="#" method="POST" class="w-full">
                              <div class="flex flex-wrap -mx-3 mb-6  p-3">

                                   <div class="w-full px-3 mb-6 md:mb-0">
                                        <label for="kode"
                                             class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Kode:</label>
                                        <input type="text" id="kode" name="kode_barang"
                                             class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-400 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                             placeholder="Masukkan Kode" required
                                             value="<?= $update['kode_all_transaksi']?>">
                                   </div>
                                   <div class="w-full px-3 mb-6 md:mb-0">
                                        <label for="nama"
                                             class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Nama:</label>
                                        <input type="text" id="nama" name="nama_barang"
                                             class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-400 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                             placeholder="Masukkan Nama" required value="<?= $update['nama_barang']?>">
                                   </div>
                                   <div class="w-full px-3 mb-6 md:mb-0">
                                        <label for="nama"
                                             class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Harga:</label>
                                        <input type="text" id="nama" name="harga_barang"
                                             class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-400 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                             placeholder="Masukkan Harga" required
                                             value="<?= $update['harga_barang']?>">
                                   </div>
                                   <div class="w-full px-3 mb-6 md:mb-0">
                                        <label for="stock"
                                             class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Qty:</label>
                                        <input type="text" id="stock" name="stock_barang"
                                             class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-400 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                             placeholder="Masukkan Stock" required value="<?= $update['qty']?>">
                                   </div>
                                   <div class="w-full px-3 mb-6 md:mb-0">
                                        <label for="stock"
                                             class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Total:</label>
                                        <input type="text" id="stock" name="stock_barang"
                                             class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-400 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                             placeholder="Masukkan Stock" required value="<?= $update['total']?>">
                                   </div>
                              </div>
                              <div class="flex justify-between w-full">
                                   <div class="flex justify-start items-center">
                                        <a href="data_barang.php" class="text-blue-600">Back...</a>
                                   </div>
                                   <div class="flex items-center justify-end">
                                        <button type="submit" name="submit" id="submit"
                                             class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update
                                             Barang</button>
                                   </div>
                              </div>
                         </form>
                    </div>
               </div>
               <!-- End Content -->
          </div>
     </section>
     <script>
     document.getElementById("submit").addEventListener("keypress", function(event) {
          if (event.keyCode === 13) {
               event.preventDefault(); // Mencegah submit form default
               submitForm();
          }
     });

     // Fungsi untuk submit form
     function submitForm() {
          document.querySelector("form").submit();
     }
     </script>
</body>

</html>