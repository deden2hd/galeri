<?php
include "koneksi.php";
session_start();

$foto_judul=$_POST['foto_judul'];
$foto_deskripsi=$_POST['foto_deskripsi'];
$album_id=$_POST['album_id'];
$datetime=date("Y-m-d");
$user_id=$_SESSION['user_id'];

$rand = rand();
$ekstensi =  array('png','jpg','jpeg','gif');
$filename = $_FILES['path_file']['name'];
$ukuran = $_FILES['path_file']['size'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

if(!in_array($ext,$ekstensi) ) {
    header("location:foto.php");
}else{
    if($ukuran < 1044070){
        $xx = $rand.'_'.$filename;
        move_uploaded_file($_FILES['path_file']['tmp_name'], 'gambar/'.$rand.'_'.$filename);
        mysqli_query($conn, "INSERT INTO foto VALUES(NULL,'$foto_judul','$foto_deskripsi','$datetime','$xx','$album_id','$user_id')");
        header("location:foto.php");
    }else{
        header("location:foto.php");
    }
}
?>

