<?php
session_start();

$required_role = $_SESSION['role'];

if (!isset($_SESSION['login']) || $_SESSION['role'] !== $required_role) {
    header("Location: ../index.php");
    exit;
}
?>