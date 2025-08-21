<?php
session_start();

require_once '../../../config/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_divisi = $_POST['id_divisi'];
    $nama_divisi = $_POST['nama_divisi'];
    $deskripsi = $_POST['deskripsi'];


    $sql = $conn->query("UPDATE divisi SET nama_divisi = '$nama_divisi', deskripsi = '$deskripsi' WHERE id = '$id_divisi'  ");

    if ($sql) {
        $_SESSION['success'] = 'Berhasil Diedit';
        header('location: ../../../index.php?page=divisi');
    } else {
        $_SESSION['error'] = 'failed';
        header('location: ../../../index.php?page=divisi');
    }
}
