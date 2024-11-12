<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Landing</title>
</head>
<body>
<h1>Halaman Landing</h1>
<?php
session_start();
if(!isset($_SESSION['user_id'])){
    ?>
    <ul>
        <li><a href="register.php">Register</a></li>
        <li><a href="login.php">Login</a></li>
    </ul>
    <?php
}else{
    ?>
    <p>Selamat datang <b><?=$_SESSION['nama_lengkap']?></b></p>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="album.php">Album</a></li>
        <li><a href="foto.php">Foto</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
    <?php
}
?>


<table width="100%" border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Judul</th>
        <th>Deskripsi</th>
        <th>Foto</th>
        <th>Uploader</th>
        <th>Jumlah Like</th>
        <th>Aksi</th>
    </tr>
    <?php
    include "koneksi.php";
    $sql=mysqli_query($conn,"select * from foto,user where foto.user_id=user.user_id");
    while($data=mysqli_fetch_array($sql)){
        ?>
        <tr>
            <td><?=$data['foto_id']?></td>
            <td><?=$data['foto_judul']?></td>
            <td><?=$data['foto_deskripsi']?></td>
            <td>
                <img src="gambar/<?=$data['path_file']?>" width="200px">
            </td>
            <td><?=$data['nama_lengkap']?></td>
            <td>
                <?php
                $foto_id=$data['foto_id'];
                $sql2=mysqli_query($conn,"select * from like_foto where foto_id='$foto_id'");
                echo mysqli_num_rows($sql2);
                ?>
            </td>
            <td>
                <a href="like.php?foto_id=<?=$data['foto_id']?>">Like</a>
                <a href="komentar.php?foto_id=<?=$data['foto_id']?>">Komentar</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>

</body>
</html>
