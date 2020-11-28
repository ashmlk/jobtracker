<?php
/*CREATE TABLE `contact` (
    `id` int(16) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `email` varchar(255) NOT NULL,
    `message` TEXT
);*/
session_start();
require_once "config.php";
$query = "INSERT INTO contact (email, message) VALUES ('" . $_POST["email"] . "','" . $_POST["message"] . "')";
$results = mysqli_query($link, $query);

?>
<!DOCTYPE html>
<html>

<head>
    <title>Contact Us</title>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="bg-dark">
    <div class="container" >
        <div class="vg-white border-transparent card p-3 align-items-center">
            <h3>Contact Us</h3>
            <h2 class="mt-5">Your Message Has Been Send</h2>
        </div>

    </div>
</body>
