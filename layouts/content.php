<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

switch ($page) {
    case 'dashboard':
        include 'pages/dashboard.php';
        break;

    case 'divisi':
        include 'pages/divisi/list.php';
        break;

    case 'form-divisi':
        include 'pages/divisi/form.php';
        break;

    case 'personel':
        include 'pages/personel/list.php';
        break;

    case 'form-personel':
        include 'pages/personel/form.php';
        break;

    case 'cuti':
        include 'pages/cuti/list.php';
        break;

    case 'form-cuti':
        include 'pages/cuti/form.php';
        break;

    case 'ijin':
        include 'pages/ijin/list.php';
        break;

    case 'form-ijin':
        include 'pages/ijin/form.php';
        break;

    case 'laporan':
        include 'pages/laporan/list.php';
        break;
}
