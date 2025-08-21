<?php
require_once 'config/connect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // $pass = md5($_POST['password']);

    $query = $conn->query("SELECT * FROM login WHERE username = '$user' AND password = '$pass'");

    if ($query->num_rows > 0) {
        session_start();
        $data = $query->fetch_assoc();
        $_SESSION['username'] = $user;
        $_SESSION['nama'] = $data['nama_lengkap'];
        header('Location: index.php');
    } else {
        header('Location: login.php?error=1');
    }
}
