<?php
    include "koneksi.php";
    session_start();

    if(!isset($_SESSION['user_id'])){
        //Untuk bisa like harus login dulu
        header("location:index.php");
    }else{
        $foto_id=$_GET['foto_id'];
        $user_id=$_SESSION['user_id'];
        //Cek apakah user sudah pernah like foto ini apa belum

        $sql=mysqli_query($conn,"select * from like_foto where foto_id='$foto_id' and user_id='$user_id'");

        if(mysqli_num_rows($sql)==1){
            //User sudah pernah like foto ini
            header("location:index.php");
        }else{
            $datetime=date("Y-m-d");
            mysqli_query($conn,"insert into like_foto values('','$foto_id','$user_id','$datetime')");
            header("location:index.php");
        }
    }


?>

