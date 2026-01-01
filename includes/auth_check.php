<?php
session_start();

if (!isset($_SESSION['role'])) {
    header("Location: ../login.php");
    exit;
}

if (isset($required_role) && $_SESSION['role'] !== $required_role) {
    header("Location: ../login.php");
    exit;
}
?>