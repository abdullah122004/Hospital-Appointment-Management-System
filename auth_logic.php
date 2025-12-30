<?php
include('db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // 1. Check for Admin (Only one admin)
    if ($email == "admin" && $password == "admin123") {
        $_SESSION['role'] = 'admin';
        header("Location: admin_dashboard.php");
    } else {
        // 2. Check for Patient
        $sql = "SELECT * FROM patients WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        if ($user = mysqli_fetch_assoc($result)) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['role'] = 'patient';
            header("Location: patient_dashboard.php");
        } else {
            echo "<script>alert('Invalid Login!'); window.location='index.php';</script>";
        }
    }
}
?>