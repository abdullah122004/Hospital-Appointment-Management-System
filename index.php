<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HAMS Professional</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center; }
        .login-card { border-radius: 15px; background: rgba(255, 255, 255, 0.9); }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card login-card p-4 shadow-lg">
                    <h2 class="text-center text-primary fw-bold">NUTECH HAMS</h2>
                    <p class="text-center text-muted">Login to Continue</p>
                    <form action="auth_logic.php" method="POST">
                        <input type="text" name="email" class="form-control mb-3" placeholder="Email or 'admin'" required>
                        <input type="password" name="password" class="form-control mb-3" placeholder="Enter your password" required>
                        <button class="btn btn-primary w-100 py-2">Sign In</button>
                        <div class="text-center mt-3">
                            <a href="register.php" class="text-decoration-none small">New Patient? Register Here</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>