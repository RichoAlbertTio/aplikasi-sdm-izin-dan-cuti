<?php
$conn = mysqli_connect("localhost", "root", "", "biro_sdm");

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}