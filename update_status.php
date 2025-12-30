<?php
include('db.php');
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit();
}

if(isset($_GET['id']) && isset($_GET['status'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $status = mysqli_real_escape_string($conn, $_GET['status']);

    if($status == 'Cancelled') {
        $query = "DELETE FROM appointments WHERE id = '$id'";
    } else {
        $query = "UPDATE appointments SET status = '$status' WHERE id = '$id'";
    }

    if(mysqli_query($conn, $query)) {
        header("Location: admin_dashboard.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>