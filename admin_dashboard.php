<?php
include('db.php');
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit();
}

if(isset($_POST['add_doc'])) {
    $n = mysqli_real_escape_string($conn, $_POST['n']); 
    $s = mysqli_real_escape_string($conn, $_POST['s']); 
    $e = mysqli_real_escape_string($conn, $_POST['e']); 
    $ex = mysqli_real_escape_string($conn, $_POST['ex']);
    $c = mysqli_real_escape_string($conn, $_POST['c']); 
    $b = mysqli_real_escape_string($conn, $_POST['b']); 
    $t = mysqli_real_escape_string($conn, $_POST['t']);
    
    $query = "INSERT INTO doctors (name, specialty, education, experience, clinic_detail, branch, available_time) 
              VALUES ('$n','$s','$e','$ex','$c','$b','$t')";
    mysqli_query($conn, $query);
    echo "<script>alert('Doctor Details Added!'); window.location='admin_dashboard.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | HAMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', sans-serif; }
        .nav-admin { background-color: #1e3a8a; }
        .card-custom { border-radius: 15px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .stats-card { background: linear-gradient(45deg, #1e3a8a, #3b82f6); color: white; border-radius: 15px; }
        .table-container { background: white; border-radius: 15px; padding: 25px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

<nav class="navbar navbar-dark nav-admin mb-4 p-3 shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">HAMS | Admin Suite</a>
        <div class="d-flex">
            <a href="manage_doctors.php" class="btn btn-warning btn-sm me-2 fw-bold">Manage Doctors List</a>
            <a href="logout.php" class="btn btn-outline-light btn-sm px-3">Sign Out</a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row mb-4 g-3 text-center">
        <div class="col-md-6">
            <div class="card stats-card p-3 border-0">
                <?php $d_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM doctors")); ?>
                <h3 class="fw-bold mb-0"><?php echo $d_count['total']; ?></h3>
                <small class="opacity-75">Registered Specialists</small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card stats-card p-3 border-0" style="background: linear-gradient(45deg, #10b981, #34d399);">
                <?php $a_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM appointments WHERE status='Pending'")); ?>
                <h3 class="fw-bold mb-0"><?php echo $a_count['total']; ?></h3>
                <small class="opacity-75">Active Pending Bookings</small>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-12">
            <div class="card card-custom p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                    <h4 class="text-primary fw-bold mb-0">Add New Doctor Profile</h4>
                    <a href="manage_doctors.php" class="btn btn-outline-primary btn-sm fw-bold">View/Edit/Delete Existing Doctors</a>
                </div>
                <form method="POST" class="row g-3">
                    <div class="col-md-6"><input type="text" name="n" class="form-control py-2" placeholder="Doctor Full Name" required></div>
                    <div class="col-md-6"><input type="text" name="s" class="form-control py-2" placeholder="Specialty" required></div>
                    <div class="col-md-12"><textarea name="e" class="form-control" rows="2" placeholder="Education Details"></textarea></div>
                    <div class="col-md-12"><textarea name="ex" class="form-control" rows="2" placeholder="Experience History"></textarea></div>
                    <div class="col-md-4"><input type="text" name="c" class="form-control" placeholder="Clinic/Room No."></div>
                    <div class="col-md-4"><input type="text" name="b" class="form-control" placeholder="Hospital Branch"></div>
                    <div class="col-md-4"><input type="text" name="t" class="form-control" placeholder="Available Timings"></div>
                    <div class="col-12"><button name="add_doc" class="btn btn-primary px-5 fw-bold shadow-sm">Save Doctor Profile</button></div>
                </form>
            </div>
        </div>

        <div class="col-lg-12 mb-5">
            <div class="table-container text-center">
                <h4 class="fw-bold mb-4 text-dark border-bottom pb-2 text-start">Manage New Patient Bookings</h4>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="py-3">Patient</th>
                                <th class="py-3">Doctor Assigned</th>
                                <th class="py-3">Date</th>
                                <th class="py-3">Status</th>
                                <th class="py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT a.id, p.name as pname, d.name as dname, a.date, a.status 
                                    FROM appointments a 
                                    LEFT JOIN patients p ON a.patient_id = p.id 
                                    LEFT JOIN doctors d ON a.doctor_id = d.id 
                                    WHERE a.status = 'Pending'
                                    ORDER BY a.date ASC";
                            $result = mysqli_query($conn, $sql);

                            if(mysqli_num_rows($result) > 0) {
                                while($r = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td class="fw-bold text-secondary text-start ps-3"><?php echo htmlspecialchars($r['pname'] ?? 'Guest'); ?></td>
                                        <td class="text-primary fw-medium"><?php echo htmlspecialchars($r['dname'] ? 'Dr. '.$r['dname'] : 'Not Assigned'); ?></td>
                                        <td><?php echo date('d M, Y', strtotime($r['date'])); ?></td>
                                        <td><span class="badge bg-warning text-dark px-3 py-2">Pending</span></td>
                                        <td class="text-center">
                                            <a href="update_status.php?id=<?php echo $r['id']; ?>&status=Completed" class="btn btn-sm btn-success px-3 fw-bold">Done</a>
                                            <a href="update_status.php?id=<?php echo $r['id']; ?>&status=Cancelled" class="btn btn-sm btn-danger px-3 fw-bold" onclick="return confirm('Remove this booking?')">Cancel</a>
                                        </td>
                                    </tr>
                                <?php } 
                            } else {
                                echo "<tr><td colspan='5' class='text-center py-5 text-muted'>No new appointments found in the database.</td></tr>";
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>