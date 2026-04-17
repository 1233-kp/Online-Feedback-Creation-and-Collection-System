<?php
include 'db.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.html");
    exit();
}

if (!isset($_GET['form_id'])) {
    die("Form ID missing");
}

$form_id = intval($_GET['form_id']);

if (isset($_POST['confirm_delete'])) {

    $conn->query("
        DELETE FROM answers 
        WHERE question_id IN 
        (SELECT id FROM questions WHERE form_id = $form_id)
    ");

    $conn->query("DELETE FROM responses WHERE form_id = $form_id");
    $conn->query("DELETE FROM questions WHERE form_id = $form_id");
    $conn->query("DELETE FROM forms WHERE id = $form_id");

    header("Location: manage_forms.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Confirm Delete</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
            font-family: 'Poppins', sans-serif;
        }

        .card-custom {
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            text-align: center;
            padding: 40px;
            margin-top: 100px;
        }

        .warning-icon {
            font-size: 60px;
            color: #dc3545;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card card-custom">

            <div class="warning-icon mb-3">
                <i class="bi bi-exclamation-triangle-fill"></i>
            </div>

            <h4 class="mb-3 text-danger">Are You Sure?</h4>
            <p class="text-muted">
                This action will permanently delete this form and all associated responses.
            </p>

            <form method="POST">
                <button type="submit" name="confirm_delete" class="btn btn-danger me-2">
                    <i class="bi bi-trash"></i> Yes, Delete
                </button>

                <a href="manage_forms.php" class="btn btn-secondary">
                    Cancel
                </a>
            </form>

        </div>
    </div>

</body>

</html>