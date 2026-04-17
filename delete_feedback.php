<?php
include 'db.php';

$id = $_GET['id'];

$sql = "DELETE FROM feedback WHERE id='$id'";

if ($conn->query($sql)) {
    header("Location: view_feedback.php");
}
?>
