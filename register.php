<?php
include 'db.php';

// 👇 ADD THIS LINE
mysqli_report(MYSQLI_REPORT_OFF);

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$course = $_POST['course'];
$year = $_POST['year'];

$sql = "INSERT INTO users (name, email, password, course, year) 
        VALUES ('$name', '$email', '$password', '$course', '$year')";

if ($conn->query($sql)) {
    echo "
<div style='
    background-color:#e6ffe6;
    color:#006600;
    padding:12px;
    border-radius:8px;
    width:300px;
    margin:auto;
    text-align:center;
    font-family:Arial;
'>
    ✅ Registration Successful!
</div>
";
} else {
    if (strpos($conn->error, 'Duplicate entry') !== false) {
        echo "
        <div style='
            background-color:#ffe6e6;
            color:#cc0000;
            padding:12px;
            border-radius:8px;
            width:300px;
            margin:auto;
            text-align:center;
            font-family:Arial;
        '>
            ⚠️ Email already registered! Try a different email.
        </div>
        ";
    } else {
        echo "<div style='color:red; text-align:center;'>⚠️ Something went wrong!</div>";
    }
}
?>