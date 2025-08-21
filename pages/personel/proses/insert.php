<?php
session_start();

require_once '../../../config/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_personel = $_POST['nama_personel'];
    $nrp = $_POST['nrp'];
    $pangkat = $_POST['pangkat'];
    $id_divisi = $_POST['id_divisi'];
    $no_hp = $_POST['no_hp'];



    $sql = $conn->query("INSERT INTO personel (nama_personel, nrp, pangkat, id_divisi, no_hp) VALUES ('$nama_personel', '$nrp', '$pangkat', '$id_divisi', '$no_hp')");

    if ($sql) {
        $_SESSION['success'] = 'Berhasil Ditambah';
        header('location: ../../../index.php?page=personel');
    } else {
        $_SESSION['error'] = 'failed';
        header('location: ../../../index.php?page=personel');
    }
}
