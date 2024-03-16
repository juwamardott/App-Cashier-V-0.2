<?php

$conn = mysqli_connect("localhost","root","", "db-toko");
if(!$conn){
     echo "Gagal konek";
}


function tambahBarang($data){
     global $conn;
     $kode = $data['kode_barang'];
     $nama = $data['nama_barang'];
     $harga = $data['harga_barang'];
     $stock = $data['stock_barang'];
     $query = mysqli_query($conn,"INSERT INTO tb_barang (kode_barang, nama_barang, harga_barang, stock_barang) VALUES ('$kode', '$nama', '$harga', '$stock');");
     return $query;
}

function searchBarang($keyword){
     global $conn;
     $query = mysqli_query($conn,"SELECT * FROM tb_barang WHERE nama_barang LIKE '%$keyword%' OR kode_barang LIKE '%$keyword%'");
     // $data = mysqli_fetch_array($query);
     return $query;
}
function searchTransaksi($keyword){
     global $conn;
     $query = mysqli_query($conn,"SELECT * FROM tb_all_transaksi WHERE nama_barang LIKE '%$keyword%' OR kode_all_transaksi LIKE '%$keyword%'");
     // $data = mysqli_fetch_array($query);
     return $query;
}

function updateBarang($edit, $id){
     global $conn;
     $edit_kode = $edit['kode_barang'];
     $edit_nama = $edit['nama_barang'];
     $edit_harga = $edit['harga_barang'];
     $edit_stock = $edit['stock_barang'];
     $result = mysqli_query($conn,"UPDATE tb_barang SET kode_barang ='$edit_kode', nama_barang ='$edit_nama', harga_barang = '$edit_harga', stock_barang = '$edit_stock' WHERE id_barang ='$id'");
     return $result;
}
function updateTransaksi($edit, $id){
     global $conn;
     $edit_kode = $edit['kode_transaksi'];
     $edit_nama = $edit['nama_barang'];
     $edit_harga = $edit['harga_barang'];
     $edit_qty = $edit['qty'];
     $edit_total = $edit['total'];
     $result = mysqli_query($conn,"UPDATE tb_transaksi SET kode_transaksi ='$edit_kode', nama_barang ='$edit_nama', harga_barang = '$edit_harga', qty = '$edit_qty',total = '$edit_total' WHERE id_barang ='$id'");
     return $result;
}
function cariBarang($barang){
     global $conn;
     $namaBarang = mysqli_query($conn,"SELECT nama_barang FROM tb_barang WHERE nama_barang='$barang'");
     $outputNama = mysqli_fetch_assoc($namaBarang);
     return $outputNama;
}
function cariKode($kode){
     global $conn;
     $kodeBarang = mysqli_query($conn,"SELECT kode_barang FROM tb_barang WHERE nama_barang='$kode'");
     $outputKode = mysqli_fetch_assoc($kodeBarang);
     return $outputKode;
}
function cariHarga($harga){
     global $conn;
     $hargaBarang = mysqli_query($conn,"SELECT harga_barang FROM tb_barang WHERE nama_barang='$harga'");
     $outputHarga = mysqli_fetch_assoc($hargaBarang);
     return $outputHarga;
}
function operasiQty($qty, $harga){
     $hasil = intval($qty) * intval($harga);
     return $hasil;
     
}
function findName($kode){
     global $conn;
     $sk = mysqli_query($conn,"SELECT nama_barang FROM tb_barang WHERE kode_barang = '$kode'");
     $dt = mysqli_fetch_assoc($sk);
     return $dt;     
}
function findKode($kode){
     global $conn;
     $sk = mysqli_query($conn,"SELECT kode_barang FROM tb_barang WHERE kode_barang = '$kode'");
     $dt = mysqli_fetch_assoc($sk);
     return $dt;     
}
function findHarga($harga){
     global $conn;
     $sk = mysqli_query($conn,"SELECT harga_barang FROM tb_barang WHERE harga_barang = '$harga'");
     $dt = mysqli_fetch_assoc($sk);
     return $dt;     
}
function insertTransaksi($kode2,$nama2,$harga2,$qty,$total){
     global $conn;
     $kode = implode("",$kode2);
     $nama = implode("",$nama2);
     $harga = implode("",$harga2);
     $qty = $qty;
     $total = $total;
     $insert = mysqli_query($conn,"INSERT INTO tb_transaksi (kode_transaksi, nama_barang, harga_barang, qty, total) VALUES ('$kode', '$nama', '$harga','$qty', '$total');");
     return $insert;
}
function insertAllTransaksi($kode2,$nama2,$harga2,$qty,$total){
     global $conn;
     $kode = $kode2;
     $nama = $nama2;
     $harga = $harga2;
     $qty = $qty;
     $total = $total;
     $insert = mysqli_query($conn,"INSERT INTO tb_all_transaksi (kode_all_transaksi, nama_barang, harga_barang, qty, total) VALUES ('$kode', '$nama', '$harga','$qty', '$total');");
     return $insert;
}
function getTotal(){
     global $conn;
     $tot = mysqli_query($conn,"SELECT total FROM tb_transaksi ORDER BY id_transaksi ASC");
     $awal = 0;
     $hasil = 0;
     while($tt = mysqli_fetch_assoc($tot)){
          $total = $tt['total'];
          $hasil = $awal += $total;
     }
     return $hasil;
}
function getAllTotal(){
     global $conn;
     $tot = mysqli_query($conn,"SELECT total FROM tb_all_transaksi ORDER BY id_all_transaksi ASC");
          $awal = 0;
          $hasil = 0;
          while($tt = mysqli_fetch_assoc($tot)){
               $total = $tt['total'];
               $hasil = $awal += $total;
          }
          return $hasil;
}
function getBayar(){
     $total = getTotal();
     $bayar = $_POST['bayar'];
     $ops = intval($bayar) - $total;
     return $ops;
}
function getTotalBarang(){
     global $conn;
     $totalbarang = mysqli_query($conn,"SELECT * FROM tb_barang");
     $jumlahdata = mysqli_num_rows($totalbarang);
     $convertjmlhdata = (string) $jumlahdata;
     return $convertjmlhdata;
}
function getTotalTransaksi(){
     global $conn;
     $totaltransakasi = mysqli_query($conn,"SELECT * FROM tb_all_transaksi");
     $jumlahdata = mysqli_num_rows($totaltransakasi);
     $convertjmlhdata = (string) $jumlahdata;
     return $convertjmlhdata;
}
function operasiQtyTambah($qty,$harga){
     $hasil = intval($qty) * intval($harga);
     return $hasil;
}
function truncateKeranjang(){
     global $conn;
     $truncate = mysqli_query($conn,"TRUNCATE TABLE tb_transaksi");
     sleep(2);
     header("location:kasir.php");
}

function findQty($nama){
     global $conn;
     $qry = mysqli_query($conn,"SELECT stock_barang FROM tb_barang WHERE nama_barang = '$nama'");
     $data = mysqli_fetch_assoc($qry);
     return $data;
}

function exsQty($nama){
     global $conn;
     $qry = mysqli_query($conn,"SELECT qty FROM tb_transaksi WHERE nama_barang = '$nama'");
     $data = mysqli_fetch_assoc($qry);
     return $data;
}
function insertQty($nama,$hasil){
     global $conn;
     $sintaks = mysqli_query($conn,"UPDATE tb_barang SET stock_barang ='$hasil' WHERE nama_barang = '$nama'");
     return $sintaks;
}
function allfindQty($nama){
     global $conn;
     $qry = mysqli_query($conn, "SELECT stock_barang FROM tb_barang WHERE nama_barang = '$nama'");
     $data = mysqli_fetch_assoc($qry);
     // Pastikan query berhasil dan ada data yang ditemukan
     if ($data) {
         // Mengembalikan nilai stock_barang sebagai string
         return $data['stock_barang'];
     } else {
         return "Data tidak ditemukan";
     }
}


function register($data) {
     global $conn;
     
     $username = strtolower(stripslashes($data['username']));
     $password = mysqli_real_escape_string($conn,$data['password']);
     $password2 = mysqli_real_escape_string($conn,$data['confirm-password']);

     // cek username
     $user = mysqli_query($conn,"SELECT username FROM tb_user WHERE username = '$username'");
     if(mysqli_fetch_assoc($user)){
          echo '<script>alert("Username sudah terdaftar, Silahkan gunakan Username lain")</script>';
          return false;
     }
     
     // cek konfirmasi password
     if($password !== $password2){
          echo '<script>alert("Password tidak sama")</script>';
          return false;
     }

     // Enkripsi
     $password =  password_hash($password, PASSWORD_DEFAULT);
     // var_dump($password);

     // insert database
     mysqli_query($conn,"INSERT INTO tb_user VALUES ('','$username','$password')");

     return mysqli_affected_rows($conn);
}





?>