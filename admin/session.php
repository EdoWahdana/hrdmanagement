<?php
session_start();

$project = explode('/', $_SERVER['REQUEST_URI'])[1];

if ($_SESSION['level'] == "Admin") {
	include __DIR__ . '/../conn.php';
} else if ($_SESSION['level'] == "Superuser") {
	header('location:../index.php');
} else if ($_SESSION['level'] == "User") {
	header('location:../index.php');
} else {
    header('location:../index.php');
}
?>
