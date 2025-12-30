<?php
include('db.php');
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit();
}

$res = mysqli_query($conn, "SELECT * FROM doctors");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Manage Doctors | HAMS</title>
</head>
<body class="bg-light p-5">
<div class="container bg-white p-4 shadow rounded-4">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h3 class="text-primary fw-bold mb-0">Doctor Management</h3>
        <a href="admin_dashboard.php" class="btn btn-dark shadow-sm">Back to Dashboard</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th>Doctor Name</th>
                    <th>Specialty</th>
                    <th>Branch</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($res)) { ?>
                <tr>
                    <td class="fw-bold text-secondary"><?php echo $row['name']; ?></td>
                    <td><?php echo $row['specialty']; ?></td>
                    <td><?php echo $row['branch']; ?></td>
                    <td class="text-center">
                        <a href="edit_doctor.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm fw-bold shadow-sm px-3">Edit</a>
                        <a href="delete_doctor.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm fw-bold shadow-sm px-3" onclick="return confirm('Are you sure you want to delete this doctor profile?')">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>