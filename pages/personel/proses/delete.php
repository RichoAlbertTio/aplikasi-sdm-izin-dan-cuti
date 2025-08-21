<?php
session_start();

require_once '../../../config/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_personel = $_POST['id_personel'];

    $sql = $conn->query("DELETE FROM personel WHERE id = '$id_personel'");

    if ($sql) {
        $_SESSION['success'] = 'berhasil di hapus';
    } else {
        $_SESSION['error'] = 'Failed';
    }

    header('location: ../../../index.php?page=personel');
}
