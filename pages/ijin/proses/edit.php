<?php
session_start();

require_once '../../../config/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $id_personel = $_POST['id_personel'];
    $status = $_POST['status'];
    $berangkat = $_POST['berangkat'];
    $kembali = $_POST['kembali'];
    $keterangan = $_POST['keterangan'];


    $sql = $conn->query("UPDATE cuti_ijin SET id_personel = '$id_personel', status = '$status', berangkat = '$berangkat', kembali = '$kembali', keterangan = '$keterangan' WHERE id = '$id'  ");

    if ($sql) {
        $_SESSION['success'] = 'Berhasil Ditambah';
        header('location: ../../../index.php?page=ijin');
    } else {
        $_SESSION['error'] = 'failed';
        header('location: ../../../index.php?page=ijin');
    }
}
