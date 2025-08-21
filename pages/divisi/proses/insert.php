<?php
session_start();

require_once '../../../config/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_divisi = $_POST['nama_divisi'];
    $deskripsi = $_POST['deskripsi'];
    

    $sql = $conn->query("INSERT INTO divisi (nama_divisi, deskripsi) VALUES ('$nama_divisi', '$deskripsi')");
    
    if ($sql) {
        $_SESSION['success'] = 'Berhasil Ditambah';
        header('location: ../../../index.php?page=divisi');
    } else {
        $_SESSION['error'] = 'failed';
        header('location: ../../../index.php?page=divisi');
    }
}