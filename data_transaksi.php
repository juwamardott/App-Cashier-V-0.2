<?php
session_start();
if(!isset($_SESSION['login'])){
     header("location:login.php");
     exit;
}
require 'function.php';
$jmlDataperhalaman = 10;
$cariTotal = mysqli_query($conn,"SELECT * FROM tb_all_transaksi");
$jumlahdata = mysqli_num_rows($cariTotal);
$jmlHalaman = ceil($jumlahdata / $jmlDataperhalaman);
$hlmAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;

$awaldata = ($jmlDataperhalaman * $hlmAktif) - $jmlDataperhalaman;
$transaksi = mysqli_query($conn,"SELECT * FROM tb_all_transaksi ORDER BY id_all_transaksi DESC LIMIT $awaldata,$jmlDataperhalaman");


if(isset($_POST['cari-transaksi'])){
     $transaksi = searchTransaksi($_POST['keyword-transaksi']);
     if($_POST['keyword-transaksi']){
     }else{
          echo '<script>alert("Isi Dulu Keyword Pencarian !!!!")</script>';
          $transaksi = mysqli_query($conn,"SELECT * FROM tb_all_transaksi ORDER BY id_all_transaksi DESC LIMIT $awaldata,$jmlDataperhalaman");
     }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Data Transaksi</title>
     <link rel="stylesheet" href="./src/output.css">
     <style>
     @import url('https://fonts.googleapis.com/css2?family=Abel&family=Quicksand:wght@300..700&display=swap');
     </style>
</head>

<body class="">
     <section id="">
          <div class="w-full flex justify-between font-quicksand font-semibold">
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
               <div class="h-svh w-[79%] overflow-auto flex justify-evenly flex-wrap gap-5 pt-2 bg-putih-0">
                    <div class="container mx-auto p-2 shadow-md">
                         <h1 class="text-2xl font-bold">Data Transaksi</h1>
                         <div class="py-2 w-auto flex items-center">
                              <form action="" method="post" class="w-full flex">
                                   <input type="text" class="p-2  bg-slate-200 border border-slate-400 rounded-l-md"
                                        name="keyword-transaksi">
                                   <button type="submit" name="cari-transaksi" id="cari-transaksi"
                                        class="p-1 bg-hero-0 rounded-r-md text-white">Cari
                                        transaksi..</button>
                              </form>
                         </div>
                         <table class="min-w-full bg-white mt-2">
                              <thead class="bg-hero-0 text-white">
                                   <tr>
                                        <th class="px-4 py-2">Kode All Transaksi</th>
                                        <th class="px-4 py-2">Nama Barang</th>
                                        <th class="px-4 py-2">Harga Barang</th>
                                        <th class="px-4 py-2">Qty</th>
                                        <th class="px-4 py-2">Total</th>
                                        <th class="px-4 py-2">Aksi</th>
                                   </tr>
                              </thead>
                              <tbody class="text-gray-700 text-sm">
                                   <?php foreach($transaksi as $row): 
                                        ?>
                                   <tr>
                                        <td class="border px-4 py-2"><?= $row['kode_all_transaksi']?></td>
                                        <td class="border px-4 py-2"><?= $row['nama_barang']?></td>
                                        <td class="border px-4 py-2"><?= $row['harga_barang']?></td>
                                        <td class="border px-4 py-2"><?= $row['qty']?></td>
                                        <td class="border px-4 py-2"><?= $row['total']?></td>
                                        <td class="border px-4 py-2">
                                             <div class="action text-center flex justify-between p-2">
                                                  <a href="update_transaksi.php?id=<?=$row['id_all_transaksi'];?>"
                                                       class="edit text-decoration-none"><img src="./icon/edit.png"
                                                            alt="" class="w-5"></a>
                                                  <a href="hapus_transaksi.php?id=<?=$row['id_all_transaksi'];?>"
                                                       class="btn btn-danger">
                                                       <img src="./icon/bin.png" alt="" class=" w-5"></a>
                                             </div>
                                        </td>
                                   </tr>
                                   <?php endforeach;?>
                              </tbody>
                         </table>
                         <div class="w-full text-center mt-5">
                              <?php if($hlmAktif > 1) :?>
                              <a href="data_transaksi.php?page=<?= $hlmAktif - 1;?>" class="text-hero-0"
                                   id="prev">Prev</a>
                              <?php endif;?>
                              <?php if($hlmAktif < $jmlHalaman) :?>
                              <a href="data_transaksi.php?page=<?=$hlmAktif + 1;?>" class="text-hero-0"
                                   id="next">Next</a>
                              <?php endif; ?>
                         </div>

                    </div>
               </div>
               <!-- End Content -->
          </div>
     </section>
</body>

</html>