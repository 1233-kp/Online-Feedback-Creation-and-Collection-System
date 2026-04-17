<?php
include 'db.php';
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    echo "Typed Password: " . $password . "<br>";
    echo "Stored Hash: " . $row['password'] . "<br>";

    if (password_verify($password, $row['password'])) {
        $_SESSION['admin_id'] = $row['id'];
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "<b>Invalid Password!</b>";
    }
} else {
    echo "Admin not found!";
}
?>