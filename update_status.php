<?php
include 'db.php';

$id = $_GET['id'];

$sql = "UPDATE feedback SET status='Reviewed' WHERE id='$id'";

if ($conn->query($sql)) {
    header("Location: view_feedback.php");
}
?>
