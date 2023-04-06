<?php
    require_once 'dbkoneksi.php';

    $sql = "SELECT * FROM vendor";
    $stmt = $conn->prepare($sql);
    $stmt->execute();


    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $nomor = $_POST['nomor'];
        $nama = $_POST['nama'];
        $kota = $_POST['kota'];
        $kontak = $_POST['kontak'];


        $sql = "INSERT INTO vendor (id, nomor, nama, kota, kontak)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id, $nomor, $nama, $kota, $kontak]);

        header("Location: index.php");
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=a, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="form.php">TAMBAH VENDOR</a>
    <hr>
    <table border="1" >
    <thead>
        <tr>
            <th>Id</th>
            <th>Nomor</th>
            <th>Nama</th>
            <th>Kota</th>
            <th>Kontak</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    
        <?php 
            $number = 1;
            while($row = $stmt->fetch(PDO::FETCH_ASSOC))  :
        ?>

        <tr>
            <td> <?= $number  ?></td>
            <td> <?= $row['nomor'] ?> </td>
            <td> <?= $row['nama'] ?> </td>
            <td> <?= $row['kota'] ?>
            <td> <?= $row['kontak'] ?> </td>
            <td>
                <a href="edit.php?id= <?= $row['id'] ?>">EDIT</a>
                <a href="delete.php?id= <?= $row['id'] ?>">DELETE</a>
            </td>
        </tr>

        <?php
            $number++;
            endwhile;
        ?>

    </tbody>
    </table>
</body>
</html>