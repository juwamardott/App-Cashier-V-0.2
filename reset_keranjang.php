<?php
session_start();
if(!isset($_SESSION['login'])){
     header("location:login.php");
     exit;
}
require 'function.php';

$truncate = mysqli_query($conn,"TRUNCATE TABLE tb_transaksi");
header("location:kasir.php");
?>