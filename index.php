<?php
session_start();
if(!isset($_SESSION['login'])){
     header("location:login.php");
     exit;
}
require 'function.php';
// Query untuk mengambil data transaksi dari database
$sintaks  = mysqli_query($conn,"SELECT nama_barang, SUM(total) AS total_semua, SUM(qty) AS total_qty
FROM tb_all_transaksi
GROUP BY nama_barang;");
$dataTransaksi = array();
while ($row = mysqli_fetch_assoc($sintaks)) {
    $dataTransaksi[] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Apps Cashier</title>
     <link rel="stylesheet" href="./src/output.css">
     <style>
     @import url('https://fonts.googleapis.com/css2?family=Abel&family=Quicksand:wght@300..700&display=swap');
     </style>
     <!-- Tautan ke Chart.js dari CDN -->
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="">
     <section id="">
          <div class="w-full flex relative justify-between font-quicksand font-semibold">
               <!-- Sidebar -->
               <div class="h-svh w-[20%] overflow-auto bg-hero-0" id="sidebar">
                    <div class="w-[90%] mx-auto  border-2 my-5 rounded-sm shadow-md">
                         <img src="./img/logo-toko.png" alt="" class="w-32 mx-auto">
                    </div>
                    <hr>
                    <div
                         class="w-[90%] overflow-hidden mx-auto flex justify-center gap-2 items-center  mt-5 px-2 py-1 rounded-md bg-putih-0 bg-opacity-35 shadow-md">
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
               <div class="h-svh overflow-auto py-2 w-[79%] mr-0 border-4 px-5">
                    <div class="w-full flex  gap-5 justify-evenly overflow-auto font-semibold text-white">
                         <div
                              class=" bg-indigo-500  w-[300px] h-[200px] rounded-md grid grid-cols-1 justify-center text-center shadow-md py-3">
                              <h1 class="uppercase text-xl">Total Barang</h1>
                              <h1 class="ml-3 text-6xl">
                                   <?= getTotalBarang();?>
                              </h1>
                         </div>
                         <div
                              class=" bg-yellow-500  w-[300px] h-[200px] rounded-md grid grid-cols-1 justify-center text-center shadow-md py-3">
                              <h1 class="uppercase text-xl">Total Transaksi</h1>
                              <h1 class="ml-3 text-6xl">
                                   <?= getTotalTransaksi();?>
                              </h1>
                         </div>
                         <div
                              class=" bg-green-800  w-[300px] h-[200px] rounded-md grid grid-cols-1 justify-center text-center shadow-md py-3">
                              <h1 class="uppercase text-xl">Total Pendapatan</h1>
                              <h1 class="ml-3 text-5xl">
                                   <?= number_format(getAllTotal(), 0, ',', '.');?>
                              </h1>
                         </div>
                    </div>
                    <canvas id="myChart" class="mt-10 w-[100%] h-[80%]"></canvas>
               </div>
               <!-- pop up logout -->
               <div id="pop-up-logout"
                    class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden justify-center items-center">
                    <div class="bg-white p-8 rounded-lg shadow-lg w-[30%]">
                         <div class="flex justify-center items-center mb-4">
                              <h2 class="text-2xl font-bold text-green-600">Berhasil Logout!!</h2>
                         </div>
                         <p class="text-lg text-gray-800 text-center">Hati Hati di Jalan.</p>
                         <div class="mt-6 flex justify-center animate-bounce">
                              <img src="./icon/checklist.png" alt="Checkmark" class="w-12 h-12">
                         </div>
                    </div>
               </div>
               <!-- end pop up logout -->
          </div>
          <!-- End Content -->
          </div>
     </section>
     <script>
     const logout = document.querySelector('#logout');
     const popup = document.querySelector('#pop-up-logout');
     logout.addEventListener('click', function() {
          <?php sleep(1); ?>
          popup.style.display = 'flex';
     })
     </script>
     <script>
     // Data transaksi (contoh)
     const dataTransaksi = <?php echo json_encode($dataTransaksi); ?>;

     // Mengambil konteks dari elemen canvas
     const ctx = document.getElementById('myChart').getContext('2d');

     // Menginisialisasi array untuk label (nama barang) dan data (total)
     const labels = dataTransaksi.map(item => item.nama_barang);
     const dataTotal = dataTransaksi.map(item => parseFloat(item.total_semua));
     const dataQty = dataTransaksi.map(item => parseFloat(item.total_qty));

     // Membuat grafik bar menggunakan Chart.js
     const myChart = new Chart(ctx, {
          type: 'bar',
          data: {
               labels: labels,
               datasets: [{
                    label: 'Total Transaksi per Barang',
                    data: dataTotal,
                    backgroundColor: 'rgba(0, 154, 255, 1)',
                    borderColor: 'rgba(0, 0, 9, 0.1)',
                    borderWidth: 1,
               }, {
                    label: 'Total Qty per Barang',
                    data: dataQty,
                    backgroundColor: 'rgba(255, 26, 9, 0.6)',
                    borderColor: 'rgba(0, 0, 9, 0.1)',
                    borderWidth: 1,
                    yAxisID: 'right-y-axis'
               }]
          },
          options: {
               scales: {
                    y: {
                         beginAtZero: true
                    },
                    'right-y-axis': {
                         position: 'right',
                         beginAtZero: true
                    }
               }
          }
     });
     </script>
</body>

</html>