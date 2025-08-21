<?php
session_start();

require_once '../../../config/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_divisi = $_POST['id_divisi'];

    $sql = $conn->query("DELETE FROM divisi WHERE id = '$id_divisi'");

    if ($sql) {
        $_SESSION['success'] = 'done yes';
    } else {
        $_SESSION['error'] = 'Failed';
    }

    header('location: ../../../index.php?page=divisi');
}