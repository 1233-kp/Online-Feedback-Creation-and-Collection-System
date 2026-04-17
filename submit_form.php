<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$form_id = intval($_POST['form_id']);
$answers = $_POST['answer'];

$stmt = $conn->prepare("INSERT INTO responses (form_id, user_id) VALUES (?, ?)");
$stmt->bind_param("ii", $form_id, $user_id);
$stmt->execute();

$response_id = $stmt->insert_id;

foreach ($answers as $question_id => $answer) {
    $stmt2 = $conn->prepare("INSERT INTO answers (response_id, question_id, answer) VALUES (?, ?, ?)");
    $stmt2->bind_param("iis", $response_id, $question_id, $answer);
    $stmt2->execute();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Feedback Submitted | Student Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .success-card {
            background: white;
            padding: 50px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 100%;
        }

        .success-icon {
            font-size: 70px;
            color: #28a745;
        }

        .btn-purple {
            background-color: #764ba2;
            border: none;
        }

        .btn-purple:hover {
            background-color: #5a3e8b;
        }
    </style>
</head>

<body>

    <div class="success-card">

        <div class="success-icon mb-3">
            <i class="bi bi-check-circle-fill"></i>
        </div>

        <h3 class="mb-3">Feedback Submitted Successfully 🎉</h3>
        <p class="text-muted">
            Thank you for submitting your feedback. Your response has been recorded.
        </p>

        <div class="mt-4">
            <a href="available_forms.php" class="btn btn-purple text-white me-2">
                <i class="bi bi-pencil-square"></i> Fill Another Form
            </a>

            <a href="user_dashboard.php" class="btn btn-secondary">
                <i class="bi bi-house"></i> Dashboard
            </a>
        </div>

    </div>

</body>

</html>