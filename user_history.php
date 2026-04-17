<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

/* Get all responses of this user */
$stmt = $conn->prepare("
    SELECT responses.id AS response_id,
           forms.title,
           responses.created_at
    FROM responses
    JOIN forms ON responses.form_id = forms.id
    WHERE responses.user_id = ?
    ORDER BY responses.id DESC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$responses = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Feedback History | Student Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
        }

        .navbar-custom {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .navbar-custom .navbar-brand {
            color: white !important;
        }

        .card-custom {
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .answer-box {
            background: #f8f9fa;
            padding: 10px 15px;
            border-radius: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom px-4">
        <a class="navbar-brand" href="user_dashboard.php">
            <i class="bi bi-mortarboard-fill"></i> Student Panel
        </a>
        <div class="ms-auto">
            <a href="user_dashboard.php" class="btn btn-light btn-sm me-2">
                <i class="bi bi-arrow-left"></i> Dashboard
            </a>
            <a href="logout.php" class="btn btn-light btn-sm">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>
    </nav>

    <div class="container mt-5">

        <div class="mb-4">
            <h3>My Submitted Feedback</h3>
            <p class="text-muted">Below are all the forms you have submitted.</p>
        </div>

        <?php if ($responses->num_rows > 0) { ?>

            <?php while ($resp = $responses->fetch_assoc()) { ?>

                <div class="card card-custom p-4 mb-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">
                            <?php echo htmlspecialchars($resp['title']); ?>
                        </h5>
                        <small class="text-muted">
                            Submitted on:
                            <?php echo htmlspecialchars($resp['created_at']); ?>
                        </small>
                    </div>

                    <hr>

                    <?php
                    /* Get answers for this response */
                    $stmt2 = $conn->prepare("
                    SELECT questions.question_text, answers.answer
                    FROM answers
                    JOIN questions ON answers.question_id = questions.id
                    WHERE answers.response_id = ?
                ");
                    $stmt2->bind_param("i", $resp['response_id']);
                    $stmt2->execute();
                    $answers = $stmt2->get_result();

                    while ($ans = $answers->fetch_assoc()) {
                    ?>
                        <div class="answer-box">
                            <strong>
                                <?php echo htmlspecialchars($ans['question_text']); ?>
                            </strong>
                            <br>
                            <?php echo htmlspecialchars($ans['answer']); ?>
                        </div>
                    <?php } ?>

                </div>

            <?php } ?>

        <?php } else { ?>

            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle"></i>
                You have not submitted any feedback yet.
            </div>

        <?php } ?>

    </div>

</body>

</html>