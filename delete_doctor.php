<?php
include('db.php');
session_start();

if($_SESSION['role'] == 'admin' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Doctor ko delete karne se pehle check karein ke appointments to nahi
    // Par PBL level par direct delete bhi chalta hai
    $sql = "DELETE FROM doctors WHERE id = '$id'";
    
    if(mysqli_query($conn, $sql)) {
        echo "<script>alert('Doctor deleted successfully!'); window.location='manage_doctors.php';</script>";
    } else {
        echo "<script>alert('Error deleting doctor. Check if they have active appointments.'); window.location='manage_doctors.php';</script>";
    }
} else {
    header("Location: index.php");
}
?>