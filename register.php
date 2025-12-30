<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Patient Registration - HAMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(to right, #ece9e6, #ffffff); height: 100vh; display: flex; align-items: center; }
        .reg-card { border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); border: none; }
        .btn-register { background: #0d6efd; border: none; border-radius: 10px; padding: 10px; font-weight: bold; }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card reg-card p-5 bg-white">
                <h2 class="text-center text-primary fw-bold mb-4">Create Account</h2>
                <form action="reg_logic.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Full Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter your Full Name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter a strong password" required>
                    </div>
                    <button type="submit" name="register_btn" class="btn btn-primary w-100 btn-register shadow">Register Now</button>
                    <div class="text-center mt-3">
                        <span class="text-muted small">Already a member?</span> <a href="index.php" class="text-decoration-none fw-bold">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
