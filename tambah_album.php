<?php
include "koneksi.php";
session_start();

$album_nama=$_POST['album_nama'];
$album_deskripsi=$_POST['album_deskripsi'];
$datetime=date("Y-m-d");
$user_id=$_SESSION['user_id'];

$sql=mysqli_query($conn,"insert into album VALUES('','$album_nama','$album_deskripsi','$datetime','$user_id')");

header("location:album.php");
?>

