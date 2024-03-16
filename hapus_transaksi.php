<?php
session_start();
if(!isset($_SESSION['login'])){
     header("location:login.php");
     exit;
}
require 'function.php';

$id_hapus = $_GET['id'];
$hapus = mysqli_query($conn,"DELETE FROM tb_all_transaksi WHERE id_all_transaksi = '$id_hapus'");
header("Location:data_transaksi.php");

?>