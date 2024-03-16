<?php
session_start();
if(!isset($_SESSION['login'])){
     header("location:login.php");
     exit;
}
require 'function.php';

$id_hapus = $_GET['id'];
$hapus = mysqli_query($conn,"DELETE FROM tb_barang WHERE id_barang = '$id_hapus'");
header("Location:data_barang.php");

?>