<?php

require './function.php';
$data = getTransaksi();
?>


<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Nota Belanja</title>
     <link rel="stylesheet" href="./src/output.css">
</head>

<body class="bg-gray-100 p-4">
     <div class="max-w-md mx-auto bg-white p-8 rounded shadow-md h-auto hero content">
          <h1 class="text-2xl font-bold mb-4 text-center">Nota Belanja</h1>
          <div class="mb-4 text-center judul">
               <p class="font-semibold">Nama Toko: Toko Barokah</p>
               <p class="text-sm">Alamat: Jl. Raya Kebun Jeruk No. 123</p>
          </div>
          <table class="w-full mb-4 mx-auto">
               <thead>
                    <tr>
                         <th class="px-4 py-2 bg-gray-200 text-left">Item</th>
                         <th class="px-4 py-2 bg-gray-200 text-left">Harga</th>
                         <th class="px-4 py-2 bg-gray-200 text-left">Qty</th>
                         <th class="px-4 py-2 bg-gray-200 text-left">Subtotal</th>
                    </tr>
               </thead>
               <tbody>
                    <?php while($row = mysqli_fetch_assoc($data)) :  ?>
                    <tr class="lowercase">
                         <td class="border px-4 py-2"><?=$row['nama_barang']?></td>
                         <td class="border px-4 py-2"><?=$row['harga_barang']?></td>
                         <td class="border px-4 py-2"><?=$row['qty']?></td>
                         <td class="border px-4 py-2"><?=$row['total']?></td>
                    </tr>
                    <?php endwhile;?>


               </tbody>
          </table>
          <div class="flex justify-between">
               <p class="font-semibold total">Total:</p>
               <p class="font-semibolda angka"><?=getTotal()?></p>
          </div>
          <div class="mt-4">
               <p class="text-xs text-center">Terima kasih telah berbelanja di Toko Barokah.</p>
          </div>
     </div>
</body>

</html>