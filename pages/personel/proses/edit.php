<?php
session_start();

require_once '../../../config/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama_personel = $_POST['nama_personel'];
    $nrp = $_POST['nrp'];
    $pangkat = $_POST['pangkat'];
    $id_divisi = $_POST['id_divisi'];
    $no_hp = $_POST['no_hp'];


    $sql = $conn->query("UPDATE personel SET nama_personel = '$nama_personel', nrp = '$nrp', pangkat = '$pangkat', id_divisi = '$id_divisi', no_hp = '$no_hp' WHERE id = '$id'  ");

    if ($sql) {
        $_SESSION['success'] = 'Berhasil di edit';
        header('location: ../../../index.php?page=personel');
    } else {
        $_SESSION['error'] = 'failed';
        header('location: ../../../index.php?page=personel');
    }
}
