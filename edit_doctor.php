<?php
include('db.php');
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit();
}

if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $res = mysqli_query($conn, "SELECT * FROM doctors WHERE id = '$id'");
    $d = mysqli_fetch_assoc($res);
    
    if(!$d) {
        header("Location: manage_doctors.php");
        exit();
    }
}

if(isset($_POST['update_doc'])) {
    $id = $_POST['id'];
    $n = mysqli_real_escape_string($conn, $_POST['n']); 
    $s = mysqli_real_escape_string($conn, $_POST['s']); 
    $e = mysqli_real_escape_string($conn, $_POST['e']); 
    $ex = mysqli_real_escape_string($conn, $_POST['ex']);
    $c = mysqli_real_escape_string($conn, $_POST['c']); 
    $b = mysqli_real_escape_string($conn, $_POST['b']); 
    $t = mysqli_real_escape_string($conn, $_POST['t']);

    $sql = "UPDATE doctors SET 
            name='$n', specialty='$s', education='$e', 
            experience='$ex', clinic_detail='$c', 
            branch='$b', available_time='$t' 
            WHERE id='$id'";

    if(mysqli_query($conn, $sql)) {
        echo "<script>alert('Doctor Profile Updated!'); window.location='manage_doctors.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Doctor | HAMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
<div class="container bg-white p-4 shadow rounded-4" style="max-width: 800px;">
    <h3 class="text-primary fw-bold mb-4 border-bottom pb-2">Update Doctor Information</h3>
    <form method="POST" class="row g-3">
        <input type="hidden" name="id" value="<?php echo $d['id']; ?>">
        <div class="col-md-6">
            <label class="form-label fw-bold">Doctor Name</label>
            <input type="text" name="n" class="form-control" value="<?php echo $d['name']; ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-bold">Specialty</label>
            <input type="text" name="s" class="form-control" value="<?php echo $d['specialty']; ?>" required>
        </div>
        <div class="col-md-12">
            <label class="form-label fw-bold">Education History</label>
            <textarea name="e" class="form-control" rows="2"><?php echo $d['education']; ?></textarea>
        </div>
        <div class="col-md-12">
            <label class="form-label fw-bold">Past Experience</label>
            <textarea name="ex" class="form-control" rows="2"><?php echo $d['experience']; ?></textarea>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-bold">Clinic Room</label>
            <input type="text" name="c" class="form-control" value="<?php echo $d['clinic_detail']; ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label fw-bold">Hospital Branch</label>
            <input type="text" name="b" class="form-control" value="<?php echo $d['branch']; ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label fw-bold">Availability</label>
            <input type="text" name="t" class="form-control" value="<?php echo $d['available_time']; ?>">
        </div>
        <div class="col-12 mt-4">
            <button name="update_doc" class="btn btn-success px-5 fw-bold shadow-sm">Update Profile</button>
            <a href="manage_doctors.php" class="btn btn-secondary px-5 fw-bold shadow-sm ms-2">Cancel</a>
        </div>
    </form>
</div>
</body>
</html>