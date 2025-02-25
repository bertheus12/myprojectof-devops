<?php
session_start();

// Database connection
$servername = "localhost"; // Change if necessary
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "work"; // Change to your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $gender = trim($_POST['gender']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate input
    if (!empty($firstname) && !empty($lastname) && !empty($gender) && !empty($email) && !empty($password)) {
        // Check if email already exists
        $checkEmail = $conn->prepare("SELECT id FROM user WHERE email = ?");
        $checkEmail->bind_param("s", $email);
        $checkEmail->execute();
        $checkEmail->store_result();

        if ($checkEmail->num_rows > 0) {
            $_SESSION['error'] = "Email already registered. Please use another one.";
            $checkEmail->close();
            header("Location: registration.php");
            exit();
        }
        $checkEmail->close();

        // Hash the password before storing
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user into database
        $stmt = $conn->prepare("INSERT INTO user (firstname, lastname, gender, email, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $firstname, $lastname, $gender, $email, $hashed_password);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Registration successful! You can now log in.";
            header("Location: login.php");
            exit();
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again.";
        }

        $stmt->close();
    } else {
        $_SESSION['error'] = "All fields are required.";
    }
}

$conn->close();
header("Location: registration.php");
exit();
?>
