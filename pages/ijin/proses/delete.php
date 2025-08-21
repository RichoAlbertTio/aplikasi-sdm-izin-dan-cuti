<?php
session_start();

require_once '../../../config/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $sql = $conn->query("DELETE FROM cuti_ijin WHERE id = '$id'");

    if ($sql) {
        $_SESSION['success'] = 'done yes';
    } else {
        $_SESSION['error'] = 'Failed';
    }

    header('location: ../../../index.php?page=ijin');
}
