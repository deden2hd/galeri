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
    <title>Halaman Foto</title>
</head>
<body>
<h1>Halaman Foto</h1>
<p>Selamat datang <b><?=$_SESSION['nama_lengkap']?></b></p>

<ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="album.php">Album</a></li>
    <li><a href="foto.php">Foto</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>

<form action="tambah_foto.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Judul</td>
            <td><input type="text" name="foto_judul"></td>
        </tr>
        <tr>
            <td>Deskripsi</td>
            <td><input type="text" name="foto_deskripsi"></td>
        </tr>
        <tr>
            <td>Lokasi File</td>
            <td><input type="file" name="path_file"></td>
        </tr>
        <tr>
            <td>Album</td>
            <td>
                <select name="album_id">
                    <?php
                    include "koneksi.php";
                    $user_id=$_SESSION['user_id'];
                    $sql=mysqli_query($conn,"select * from album where user_id='$user_id'");
                    while($data=mysqli_fetch_array($sql)){
                        ?>
                        <option value="<?=$data['album_id']?>"><?=$data['album_nama']?></option>
                        <?php
                    }
                    ?>
                </select>

            </td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Tambah"></td>
        </tr>
    </table>
</form>

<table border="1" cellpadding=5 cellspacing=0>
    <tr>
        <th>ID</th>
        <th>Judul</th>
        <th>Deskripsi</th>
        <th>Tanggal Unggah</th>
        <th>Lokasi File</th>
        <th>Album</th>
        <th>Disukai</th>
        <th>Aksi</th>
    </tr>
    <?php
    include "koneksi.php";
    $userid=$_SESSION['user_id'];
    $sql=mysqli_query($conn,"select * from foto,album where foto.user_id='$user_id' and foto.album_id=album.album_id");
    while($data=mysqli_fetch_array($sql)){
        ?>
        <tr>
            <td><?=$data['foto_id']?></td>
            <td><?=$data['foto_judul']?></td>
            <td><?=$data['foto_deskripsi']?></td>
            <td><?=$data['datetime']?></td>
            <td>
                <img src="gambar/<?=$data['path_file']?>" width="200px">
            </td>
            <td><?=$data['album_nama']?></td>
            <td>
                <?php
                $foto_id=$data['foto_id'];
                $sql2=mysqli_query($conn,"select * from like_foto where foto_id='$foto_id'");
                echo mysqli_num_rows($sql2);
                ?>
            </td>
            <td>
                <a href="hapus_foto.php?fotoid=<?=$data['foto_id']?>">Hapus</a>
                <a href="edit_foto.php?fotoid=<?=$data['foto_id']?>">Edit</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
</body>
</html>

