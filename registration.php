<?php
session_start();
$error = isset($_SESSION['error']) ? $_SESSION['error'] : "";
$success = isset($_SESSION['success']) ? $_SESSION['success'] : "";
unset($_SESSION['error']); // Clear error after displaying
unset($_SESSION['success']); // Clear success after displaying
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Registration Page</h1>

        <?php if (!empty($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
        <?php if (!empty($success)) { echo "<div class='alert alert-success'>$success</div>"; } ?>

        <form method="POST" action="handlergistrer.php" class="w-50 mx-auto">
            <div class="mb-3">
                <label for="firstname" class="form-label">First Name:</label>
                <input type="text" name="firstname" id="firstname" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name:</label>
                <input type="text" name="lastname" id="lastname" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender:</label>
                <select name="gender" id="gender" class="form-select">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>
        
        <div class="mt-3 text-center">
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
