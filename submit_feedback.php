<?php
include 'db.php';
session_start();

$user_id = $_SESSION['user_id'];
$teacher_rating = $_POST['teacher_rating'];
$teaching_quality = $_POST['teaching_quality'];
$infrastructure_rating = $_POST['infrastructure_rating'];
$suggestion = $_POST['suggestion'];

$sql = "INSERT INTO feedback (user_id, teacher_rating, teaching_quality, infrastructure_rating, suggestion)
        VALUES ('$user_id', '$teacher_rating', '$teaching_quality', '$infrastructure_rating', '$suggestion')";

if ($conn->query($sql)) {
    echo "Feedback Submitted Successfully!";
} else {
    echo "Error: " . $conn->error;
}
?>
