<?php
include 'db.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.html");
    exit();
}

$form_id = $_POST['form_id'];
$question_text = $_POST['question_text'];
$question_type = $_POST['question_type'];
$options = $_POST['options'];

$stmt = $conn->prepare("INSERT INTO questions (form_id, question_text, question_type, options) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isss", $form_id, $question_text, $question_type, $options);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Question Added | Admin Panel</title>
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

        .success-icon {
            font-size: 60px;
            color: #28a745;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card card-custom">

            <div class="success-icon mb-3">
                <i class="bi bi-check-circle-fill"></i>
            </div>

            <h4 class="mb-3">Question Added Successfully 🎉</h4>
            <p class="text-muted">You can continue adding more questions or return to dashboard.</p>

            <a href="add_question.php?form_id=<?php echo $form_id; ?>"
                class="btn btn-success me-2">
                <i class="bi bi-plus-circle"></i> Add Another Question
            </a>

            <a href="admin_dashboard.php"
                class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back to Dashboard
            </a>

        </div>
    </div>

</body>

</html>