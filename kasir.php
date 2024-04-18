<?php
session_start();
if(!isset($_SESSION['login'])){
     header("location:login.php");
     exit;
}
require 'function.php';
$searchBrang = mysqli_query($conn,"SELECT * FROM tb_barang WHERE id_barang");
if(isset($_POST['button-search'])){
     $nama = cariBarang($_POST['input-search']);
     $kode = cariKode($_POST['input-search']);
     $harga = cariHarga($_POST['input-search']);
}
if(isset($_POST['hitung'])){
     $nama = findName($_POST['kode_barang']);
     $kode = findKode($_POST['kode_barang']);
     $harga = findHarga($_POST['harga_barang']);
     $qty = $_POST['qty'];
     $send = operasiQty($_POST['qty'],$_POST['harga_barang']);
}
if(isset($_POST['button-transaksi'])){
     $nama2 = findName($_POST['kode_barang']);
     $kode2 = findKode($_POST['kode_barang']);
     $harga2 = findHarga($_POST['harga_barang']);
     $qty = $_POST['qty'];
     $total = $_POST['total_barang'];
     insertTransaksi($kode2,$nama2,$harga2,$qty,$total);
}
if(isset($_POST['button-bayar'])){
     sleep(1);
     $bayar = getBayar();
     $smtTransak = mysqli_query($conn,"SELECT * FROM tb_transaksi");
     while($row = mysqli_fetch_assoc($smtTransak)){
          $datakode = $row['kode_transaksi'];
          $datanama = $row['nama_barang'];
          $dataharga = $row['harga_barang'];
          $dataqty = $row['qty'];
          $datatotal = $row['total'];
          $data1 = findQty($datanama);
          $data2 = exsQty($datanama);
          $final1 = $data1['stock_barang'];
          $final2 = $data2['qty'];
          if($final1 < $final2){
               echo '<script>alert("Stock ' . $datanama . ' Habis. Sisa stock: ' . $final1 . '"); window.location.href = "kasir.php";</script>';
               return;
          }else{
          $eksekusi = $final1 - $final2;
          insertQty($datanama,$eksekusi);
          insertAllTransaksi($datakode,$datanama,$dataharga,$dataqty,$datatotal);   
          }
     }
}
$keranjang = mysqli_query($conn,"SELECT * FROM tb_transaksi");

?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Cashier</title>
     <link rel="stylesheet" href="./src/output.css">
     <style>
     @import url('https://fonts.googleapis.com/css2?family=Abel&family=Quicksand:wght@300..700&display=swap');
     </style>
</head>

<body class="">
     <section id="">
          <div class="w-full flex justify-evenly relative font-quicksand font-semibold">
               <!-- Sidebar -->
               <div class="h-svh w-[25%] overflow-auto bg-hero-0 hidden" id="sidebar">
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
               <!-- Hamburger Menu -->
               <div class="p-3 cursor-pointer bg-putih-0" id="hamburger-menu">
                    <img src="./icon/more.png" alt=""
                         class="w-7 hover:scale-125 transition7-all ease-in-out duration-500">
               </div>
               <!-- End Side Bar -->
               <!-- Content -->
               <div class="h-svh w-[95%] overflow-auto flex justify-between px-5 gap-5 py-2 bg-putih-0">
                    <div class="h-[100%] w-[60%]">
                         <div
                              class="w-[95%] border text-center py-3 mx-auto shadow-md mt-2 bg-hero-0 text-white text-2xl font-semibold">
                              <h1>Catat Transaksi</h1>
                         </div>
                         <!-- Form Kasir -->
                         <div class="w-[100%] h-auto border mx-auto py-5 mt-5 shadow-md">
                              <form class="mb-6" method="post">
                                   <div class="mx-auto px-2 mb-5 text-lg font-semibold bg-putih-0">
                                        <div class="border-2 rounded-md flex items-center justify-center">
                                             <input type="text" placeholder="Cari barang..." class="p-2 w-full"
                                                  name="input-search" list="barang-list" autofocus autocomplete="off"
                                                  value="">
                                             <datalist id="barang-list">
                                                  <?php while($data = mysqli_fetch_assoc($searchBrang)) :?>
                                                  <option value="<?=$data['nama_barang']; ?>"></option>
                                                  <?php endwhile;?>ss
                                             </datalist>
                                             <button
                                                  class="bg-hero-0 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r-md"
                                                  name="button-search">
                                                  Cari
                                             </button>
                                        </div>

                                        <div class="border p-2 bg-putih-0 ">
                                             <label for="" class="">KODE</label>
                                             <input type="text" autocomplete="off" name="kode_barang" id=""
                                                  value="<?= isset($kode['kode_barang']) ? $kode['kode_barang'] : '' ;?>"
                                                  class="border-2 rounded-md p-1 w-full">
                                        </div>
                                        <div class="border p-2 bg-putih-0">
                                             <label for="" class="">NAMA BARANG</label>
                                             <input type="text" autocomplete="off" name="nama_barang" id=""
                                                  value="<?= isset($nama['nama_barang']) ? $nama['nama_barang'] : ''; ?>"
                                                  class="border-2 rounded-md p-1 w-full">
                                        </div>
                                        <div class="border p-2 bg-putih-0">
                                             <label for="" class="">STOCK</label>
                                             <input type="text" autocomplete="off" name="stock_barang" id=""
                                                  value="<?= isset($nama['nama_barang']) ? allfindQty($nama['nama_barang']) : '' ?>"
                                                  class="border-2 rounded-md p-1 w-full">

                                        </div>
                                        <div class="border grid grid-cols-1 p-2 bg-putih-0">
                                             <label for="">HARGA</label>
                                             <input type="number" autocomplete="off" name="harga_barang" id=""
                                                  value="<?= isset($harga['harga_barang']) ? $harga['harga_barang']: '' ;?>"
                                                  class="border-2 rounded-md p-1 w-[40%]">
                                        </div>
                                        <div class="border p-2 mt-5 bg-putih-0 mb-5">
                                             <label for="">QUANTITY</label>
                                             <input type="number" autocomplete="off" name="qty" id="qty"
                                                  value="<?=$qty;?>" class="border-2 p-1 rounded-md w-[40%] mb-2">
                                             <button
                                                  class="bg-hero-0 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                                  name="hitung" id="hitung">
                                                  Hitung / F2
                                             </button>
                                        </div>
                                        <div class="border p-2 bg-putih-0 grid grid-cols-1">
                                             <label for="">TOTAL</label>
                                             <input type="text" name="total_barang" id=""
                                                  value="<?=isset($send) ? $send : '';?>"
                                                  class="border-2  rounded-md p-1 w-[40%]">
                                        </div>
                                   </div>
                                   <div class="px-2
                                   flex justify-end">
                                        <button type="submit" name="button-transaksi" id="button-transaksi"
                                             class="bg-hero-0 hover:bg-blue-700 text-white font-bold py-2 text-base px-4 rounded">
                                             Tambah
                                             Transaksi / F3
                                        </button>
                                   </div>
                              </form>
                         </div>
                    </div>
                    <!-- End From Kasir -->
                    <!-- Keranjang -->
                    <div class="h-auto w-[70%] py-2 px-2 font-semibold shadow-md relative">
                         <div class="flex justify-between bg-hero-0 items-center px-3 mb-2">
                              <h1 class="text-2xl text-center p-3 text-white">Keranjang</h1>
                              <a href="reset_keranjang.php" id="reset_keranjang"><img src="./icon/circular.png" alt=""
                                        class="w-10 animate-spin-slow"></a>
                         </div>
                         <div class="h-[60%] w-full rounded-md  mx-auto p-2 overflow-auto">
                              <table class="w-[95%] bg-white shadow-md">
                                   <thead class="bg-hero-0 text-white">
                                        <tr>
                                             <th class="px-4 py-2">ID TRANSAKSI</th>
                                             <th class="px-4 py-2">KODE TRANSAKSI</th>
                                             <th class="px-4 py-2">NAMA BARANG</th>
                                             <th class="px-4 py-2">HARGA BARANG</th>
                                             <th class="px-4 py-2">QTY</th>
                                             <th class="px-4 py-2">TOTAL</th>
                                             <th class="px-4 py-2">AKSI</th>
                                        </tr>
                                   </thead>
                                   <tbody class="text-gray-700">
                                        <?php $id = 1;?>
                                        <?php foreach($keranjang as $krj) :?>
                                        <tr>
                                             <td class="border px-4 py-2"><?=$id++?></td>
                                             <td class="border px-4 py-2"><?=$krj['kode_transaksi']?></td>
                                             <td class="border px-4 py-2"><?=$krj['nama_barang']?></td>
                                             <td class="border px-4 py-2"><?=$krj['harga_barang']?></td>
                                             <td class="border px-4 py-2"><?=$krj['qty']?></td>
                                             <td class="border px-4 py-2">
                                                  <?= number_format($krj['total'], 0, ',', '.');?></td>
                                             <td class="border px-4 py-2">
                                                  <div class="">
                                                       <a href="hapus_item_keranjang.php?id=<?=$krj['id_transaksi'];?>"
                                                            class="text-sm text-red-600">Hapus!</a>

                                                  </div>
                                             </td>
                                        </tr>
                                        <?php endforeach;?>
                                   </tbody>
                              </table>
                         </div>
                         <div>
                              <a href="print.php" class="text-blue-500">Print</a>
                         </div>
                         <form action="" method="post" onsubmit="return confirmPayment();">
                              <div class="w-full mt-2 flex justify-end p-3 gap-2 border-2 text-2xl bg-hero-0">
                                   <label for="" class="text-white">TOTAL</label>
                                   <input type="text" name="total" id="total" class="text-center"
                                        value="<?= number_format(getTotal(), 0, ',', '.');?>">

                              </div>
                              <div
                                   class="w-full mt-5 flex items-center justify-end p-3 gap-2 border-2 text-2xl bg-hero-0">
                                   <label for="" class="text-white">BAYAR / F8</label>
                                   <input type="text" name="bayar" id="bayar" autofocus class="text-center"
                                        value="<?=isset($_POST['bayar']) ? number_format($_POST['bayar'],0,',','.') : '';?>">
                                   <button name="button-bayar" id="button-bayar"
                                        class="bg-ungu-0 p-2 hidden">Bayar</button>
                              </div>
                         </form>
                         <div class="w-full mt-5 flex justify-end p-3 gap-2 border-2 text-2xl bg-hero-0">
                              <label for="" class="text-white">KEMBALI</label>
                              <input type="number" name="kembali" id="" class="text-center"
                                   value="<?= number_format($bayar, 0, ',', '.');?>">
                         </div>
                    </div>
               </div>
               <!-- End Content -->
               <!-- Pop Up Transaksi-->
               <div id="pop-up-transaksi"
                    class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden justify-center items-center">
                    <div class="bg-white p-8 rounded-lg shadow-lg w-[30%]">
                         <div class="flex justify-center items-center mb-4">
                              <h2 class="text-2xl font-bold text-purple-700">Yesss!!</h2>
                         </div>
                         <p class="text-lg text-gray-800 text-center">Transaksimu berhasil di submit !!.</p>
                         <div class="mt-6 flex justify-center animate-bounce">
                              <img src="./icon/checklist.png" alt="Checkmark" class="w-12 h-12">
                         </div>
                    </div>
               </div>
               <!-- Uang Kurang -->
               <div id="pop-up-kurang"
                    class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden justify-center items-center">
                    <div class="bg-white p-8 rounded-lg shadow-lg w-[30%]">
                         <div class="flex justify-center items-center mb-4">
                              <h2 class="text-2xl font-bold text-red-500">Wahhh !</h2>
                         </div>
                         <p class="text-lg text-gray-800 text-center">Uang mu kurang nih !!.</p>
                         <div class="mt-6 flex justify-center animate-bounce">
                              <img src="./icon/close.png" alt="Checkmark" class="w-12 h-12">
                         </div>
                    </div>
               </div>
               <!-- Stock Habis Submit -->
               <div id="pop-up-stock"
                    class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden justify-center items-center">
                    <div class="bg-white p-8 rounded-lg shadow-lg w-[30%]">
                         <div class="flex justify-center items-center mb-4">
                              <h2 class="text-2xl font-bold text-red-500">Wahhh!!</h2>
                         </div>
                         <p class="text-lg text-gray-800 text-center">Salah Satu Stock Barang Habis!!.</p>
                         <div class="mt-6 flex justify-center animate-bounce">
                              <img src="./icon/close.png" alt="Checkmark" class="w-12 h-12">
                         </div>
                    </div>
               </div>

          </div>
     </section>
     <script>
     function confirmPayment() {
          var bayar = parseFloat(document.getElementById('bayar').value.replace(/\./g, '').replace(',', '.'));
          var total = parseFloat(document.getElementById('total').value.replace(/\./g, '').replace(',', '.'));
          const popUp = document.querySelector('#pop-up-transaksi');
          const kurang = document.querySelector('#pop-up-kurang');
          if (total > bayar) {
               kurang.style.display = 'flex';
               setTimeout(() => {
                    kurang.style.display = 'none';
               }, 1000);
               return false;
          } else {
               popUp.style.display = 'flex';
               setTimeout(() => {
                    popUp.style.display = 'none';
               }, 1000);
               return true;
          }
     }
     </script>
     <script>
     const menu = document.querySelector('#hamburger-menu');
     const sidebar = document.querySelector('#sidebar');
     menu.addEventListener('click', function() {
          sidebar.classList.toggle('hidden');
     })
     </script>
     <script>
     document.addEventListener('keydown', function(event) {
          // Cek apakah tombol yang ditekan adalah tombol F12
          if (event.key === "F2") {
               // Temukan tombol "hitung" dengan ID atau kelasnya dan klik
               var hitungButton = document.getElementById("hitung");
               if (hitungButton) {
                    hitungButton.click();
               }
          }
     });
     document.addEventListener('keydown', function(event) {
          // Cek apakah tombol yang ditekan adalah tombol F12
          if (event.key === "F3") {
               // Temukan tombol "hitung" dengan ID atau kelasnya dan klik
               var insert = document.getElementById("button-transaksi");
               if (insert) {
                    insert.click();
               }
          }
     });
     document.addEventListener('keydown', function(event) {
          // Cek apakah tombol yang ditekan adalah tombol F12
          if (event.key === "F4") {
               // Temukan tombol "hitung" dengan ID atau kelasnya dan klik
               var reset = document.getElementById("reset_keranjang");
               if (reset) {
                    reset.click();

               }
          }
     });
     document.addEventListener('keydown', function(event) {
          // Cek apakah tombol yang ditekan adalah tombol F8
          if (event.key === "F8") {
               // Temukan elemen dengan ID "bayar"
               var autofokusqty = document.getElementById("qty");
               if (autofokusqty) {
                    // Berikan fokus pada elemen
                    autofokusqty.focus();
               }
          }
     });
     document.addEventListener('keydown', function(event) {
          // Cek apakah tombol yang ditekan adalah tombol F8
          if (event.key === "F9") {
               // Temukan elemen dengan ID "bayar"
               var bayar = document.getElementById("bayar");
               if (bayar) {
                    // Berikan fokus pada elemen
                    bayar.focus();
               }
          }
     });
     </script>

</body>

</html>