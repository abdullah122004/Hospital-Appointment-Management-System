<?php
include('db.php');
session_start();

if (isset($_POST['confirm_booking'])) {
    $p_id = $_SESSION['user_id'];
    $d_id = $_POST['doctor_id'];
    $d_name = $_POST['doctor_name'];
    
    $date_input = $_POST['app_date'];
    
    // Date ko clean aur MySQL format (YYYY-MM-DD) mein convert karein
    $formatted_date = date('Y-m-d', strtotime($date_input));

    // Basic Validation
    if (!$date_input || $formatted_date == '1970-01-01' || $formatted_date == '0000-00-00') {
        echo "<script>alert('Please select a valid date!'); window.location='patient_dashboard.php';</script>";
        exit();
    }

    // Check availability
    $check = mysqli_query($conn, "SELECT * FROM appointments WHERE doctor_id='$d_id' AND date='$formatted_date' AND status='Pending'");
    
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Slot already booked for Dr. $d_name on $formatted_date. Please choose another date.'); window.location='patient_dashboard.php';</script>";
    } else {
        // Data Insert karein
        $sql = "INSERT INTO appointments (patient_id, doctor_id, date, status) VALUES ('$p_id', '$d_id', '$formatted_date', 'Pending')";
        
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Appointment successfully booked with Dr. $d_name for $formatted_date!'); window.location='patient_dashboard.php';</script>";
        } else {
            // Agar SQL error de toh alert mein nazar aaye
            echo "<script>alert('Database Error: " . mysqli_error($conn) . "'); window.location='patient_dashboard.php';</script>";
        }
    }
}
?>