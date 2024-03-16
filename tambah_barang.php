<?php
session_start();
if(!isset($_SESSION['login'])){
     header("location:login.php");
     exit;
}
require 'function.php';


if(isset($_POST['submit'])){
     if($_POST){
     $kode = mysqli_query($conn,"SELECT kode_barang FROM tb_barang");
     while($row = mysqli_fetch_assoc($kode)){
          if($_POST['kode_barang'] == $row['kode_barang']){
               sleep(1);
               echo '<script>alert("Kode yang Anda Input Sudah Ada !!!"), window.location.href = "tambah_barang.php"; </script>';
               return false;
          }
     }
     tambahBarang($_POST);
     header("Location:data_barang.php");
     }
};



?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Tambah Barang</title>
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
               <div class="h-svh w-[79%] overflow-auto flex justify-evenly gap-5 pt-2 bg-putih-0">
                    <div class="py-20">
                         <form action="#" method="POST" class="w-full">
                              <div class="flex flex-wrap -mx-3 mb-6 p-3">

                                   <div class="w-full px-3 mb-6 md:mb-0">
                                        <label for="kode"
                                             class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Kode:</label>
                                        <input type="text" id="kode" name="kode_barang"
                                             class="appearance-none block w-full border border-gray-400 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                             value="<?=isset($_POST['kode_barang']) ? $_POST['kode_barang'] : '';?>"
                                             placeholder="Masukkan Kode" required>
                                   </div>
                                   <div class="w-full px-3 mb-6 md:mb-0">
                                        <label for="nama"
                                             class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Nama:</label>
                                        <input type="text" id="nama" name="nama_barang"
                                             class="appearance-none block w-full border border-gray-400 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                             placeholder="Masukkan Nama" required>
                                   </div>
                                   <div class="w-full px-3 mb-6 md:mb-0">
                                        <label for="harga"
                                             class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Harga:</label>
                                        <input type="number" id="harga_barang" name="harga_barang"
                                             class="appearance-none block w-full border border-gray-400 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                             placeholder="Masukkan Harga" required>
                                   </div>
                                   <div class="w-full px-3 mb-6 md:mb-0">
                                        <label for="stock"
                                             class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Stock:</label>
                                        <input type="number" id="stock_barang" name="stock_barang"
                                             class="appearance-none block w-full border border-gray-400 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                             placeholder="Masukkan Stock" required>
                                   </div>
                              </div>
                              <div class="flex justify-between w-full">
                                   <div class="flex justify-start items-center">
                                        <a href="data_barang.php" class="text-ungu-0">Back...</a>
                                   </div>
                                   <div class="flex items-center justify-end">
                                        <button type="submit" name="submit" id="submit"
                                             class="bg-ungu-0 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Tambahkan
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
     document.addEventListener('keydown', function(event) {
          // Cek apakah tombol yang ditekan adalah tombol F12
          if (event.key === "F2") {
               // Temukan tombol "hitung" dengan ID atau kelasnya dan klik
               var subtmiButton = document.getElementById("submit");
               if (subtmiButton) {
                    subtmiButton.click();
               }
          }
     });
     </script>
</body>

</html>