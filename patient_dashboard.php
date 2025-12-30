<?php 
include('db.php'); 
session_start(); 

if(!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
$p_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Portal | HAMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        .navbar { background-color: #0046ad; }
        .doctor-card { border: none; border-radius: 15px; background: white; transition: 0.3s; }
        .doctor-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .status-badge { border-radius: 20px; padding: 5px 15px; font-weight: 600; font-size: 0.8rem; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark mb-4 p-3 shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">NUTECH HAMS</a>
        <div class="d-flex align-items-center text-white">
            <span class="me-3">Welcome, <?php echo $_SESSION['user_name']; ?></span>
            <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </div>
</nav>

<div class="container">
    <h3 class="fw-bold mb-3 text-primary">Book New Appointment</h3>
    <div class="row g-4 mb-5">
        <?php
        $res = mysqli_query($conn, "SELECT * FROM doctors");
        while($d = mysqli_fetch_assoc($res)) { ?>
        <div class="col-md-4">
            <div class="card doctor-card h-100 p-3 shadow-sm">
                <h5 class="fw-bold">Dr. <?php echo $d['name']; ?></h5>
                <p class="text-muted small mb-2"><?php echo $d['specialty']; ?> | <?php echo $d['experience']; ?> Years Exp.</p>
                <form action="booking_logic.php" method="POST">
                    <input type="hidden" name="doctor_id" value="<?php echo $d['id']; ?>">
                    <input type="hidden" name="doctor_name" value="<?php echo $d['name']; ?>">
                    <input type="date" name="app_date" class="form-control form-control-sm mb-2" required min="<?php echo date('Y-m-d'); ?>">
                    <button type="submit" name="confirm_booking" class="btn btn-primary btn-sm w-100 fw-bold">Book Now</button>
                </form>
            </div>
        </div>
        <?php } ?>
    </div>

    <h3 class="fw-bold mb-3 text-dark">My Appointment History</h3>
    <div class="card border-0 shadow-sm p-4 rounded-4 mb-5">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Doctor Name</th>
                        <th>Appointment Date</th>
                        <th>Current Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $my_bookings = mysqli_query($conn, "SELECT a.date, a.status, d.name as dname 
                                                      FROM appointments a 
                                                      JOIN doctors d ON a.doctor_id = d.id 
                                                      WHERE a.patient_id = '$p_id' 
                                                      ORDER BY a.date DESC");
                    
                    if(mysqli_num_rows($my_bookings) > 0) {
                        while($b = mysqli_fetch_assoc($my_bookings)) {
                            $color = ($b['status'] == 'Pending') ? 'bg-warning text-dark' : 'bg-success text-white';
                            ?>
                            <tr>
                                <td class="fw-bold">Dr. <?php echo $b['dname']; ?></td>
                                <td><?php echo date('d M, Y', strtotime($b['date'])); ?></td>
                                <td><span class="badge status-badge <?php echo $color; ?>"><?php echo $b['status']; ?></span></td>
                            </tr>
                        <?php } 
                    } else {
                        echo "<tr><td colspan='3' class='text-center text-muted py-4'>You haven't booked any appointments yet.</td></tr>";
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>