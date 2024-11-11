<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Komentar</title>
</head>
<body>
<h1>Halaman Komentar</h1>
<p>Selamat datang <b><?=$_SESSION['nama_lengkap']?></b></p>

<ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="album.php">Album</a></li>
    <li><a href="foto.php">Foto</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>

<form action="tambah_komentar.php" method="post">
    <?php
    include "koneksi.php";
    $foto_id=$_GET['foto_id'];
    $sql=mysqli_query($conn,"select * from foto where foto_id='$foto_id'");
    while($data=mysqli_fetch_array($sql)){
        ?>
        <input type="text" name="foto_id" value="<?=$data['foto_id']?>" hidden>
        <table>
            <tr>
                <td>Judul</td>
                <td><input type="text" name="foto_judul" value="<?=$data['foto_judul']?>"></td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td><input type="text" name="foto_deskripsi" value="<?=$data['foto_deskripsi']?>"></td>
            </tr>
            <tr>
                <td>Foto</td>
                <td><img src="gambar/<?=$data['path_file']?>" width="200px"></td>
            </tr>
            <tr>
                <td>Komentar</td>
                <td><input type="text" name="isikomentar"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Tambah"></td>
            </tr>
        </table>
        <?php
    }
    ?>
</form>

<table width="100%" border="1" cellpadding=5 cellspacing=0>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Komentar</th>
        <th>Tanggal</th>
    </tr>
    <?php
    include "koneksi.php";
    $userid=$_SESSION['user_id'];
    $sql=mysqli_query($conn,"select * from comment,user where comment.user_id=user.user_id");
    while($data=mysqli_fetch_array($sql)){
        ?>
        <tr>
            <td><?=$data['comment_id']?></td>
            <td><?=$data['nama_lengkap']?></td>
            <td><?=$data['comment_deskripsi']?></td>
            <td><?=$data['datetime']?></td>
        </tr>
        <?php
    }
    ?>
</table>
</body>
</html>
