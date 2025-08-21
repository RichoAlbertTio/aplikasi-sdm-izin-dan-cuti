<?php
session_start();

require_once '../../../config/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_personel = $_POST['id_personel'];
    $status = $_POST['status'];
    $keterangan = $_POST['keterangan'];
    $berangkat = $_POST['berangkat'];
    $kembali = $_POST['kembali'];
    
    

    $sql = $conn->query("INSERT INTO cuti_ijin (id_personel, status, keterangan, berangkat, kembali) VALUES ('$id_personel', '$status', '$keterangan', '$berangkat', '$kembali')");
    
    if ($sql) {
        $_SESSION['success'] = 'Berhasil Ditambah';
        header('location: ../../../index.php?page=cuti');
    } else {
        $_SESSION['error'] = 'failed';
        header('location: ../../../index.php?page=cuti');
    }
}