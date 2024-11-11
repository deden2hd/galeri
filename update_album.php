<?php
include "koneksi.php";
session_start();

$album_id=$_POST['album_id'];
$album_nama=$_POST['album_nama'];
$album_deskripsi=$_POST['album_deskripsi'];

$sql=mysqli_query($conn,"update album set album_nama='$album_nama',album_deskripsi='$album_deskripsi' where album_id='$album_id'");

header("location:album.php");
?>

