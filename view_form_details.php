<?php
include 'db.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.html");
    exit();
}

$form_id = $_GET['form_id'];

$form = $conn->query("SELECT * FROM forms WHERE id = $form_id")->fetch_assoc();

$responses = $conn->query("
    SELECT responses.id AS response_id, users.name 
    FROM responses 
    JOIN users ON responses.user_id = users.id
    WHERE responses.form_id = $form_id
");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Form Responses | Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
        }

        .sidebar {
            height: 100vh;
            background: #1e3c72;
            padding-top: 20px;
            color: white;
        }

        .sidebar h4 {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #2a5298;
            padding-left: 25px;
        }

        .header {
            padding: 20px;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .card-custom {
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .question-box {
            background-color: #f8f9fa;
            padding: 10px 15px;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .answer-box {
            padding-left: 15px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-md-2 sidebar">
                <h4>Admin Panel</h4>
                <a href="admin_dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
                <a href="create_form.php"><i class="bi bi-plus-circle"></i> Create Form</a>
                <a href="manage_forms.php"><i class="bi bi-folder"></i> Manage Forms</a>
                <a href="view_feedback.php"><i class="bi bi-chat-dots"></i> View Feedback</a>
                <a href="view_responses.php"><i class="bi bi-list-check"></i> View Responses</a>
                <a href="analytics.php"><i class="bi bi-bar-chart"></i> Analytics</a>
                <a href="export.php"><i class="bi bi-download"></i> Export Data</a>
                <a href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
            </div>

            <!-- Main Content -->
            <div class="col-md-10">

                <!-- Header -->
                <div class="header d-flex justify-content-between align-items-center">
                    <h3><?php echo $form['title']; ?> - Responses</h3>
                    <a href="view_responses.php" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>

                <div class="container mt-4">

                    <?php
                    if ($responses->num_rows > 0) {
                        while ($resp = $responses->fetch_assoc()) {
                    ?>

                            <div class="card card-custom p-4 mb-4">
                                <h5 class="mb-3">
                                    <i class="bi bi-person-circle"></i>
                                    Submitted by: <?php echo $resp['name']; ?>
                                </h5>

                                <?php
                                $answers = $conn->query(
                                    "
                                SELECT questions.question_text, answers.answer
                                FROM answers
                                JOIN questions ON answers.question_id = questions.id
                                WHERE answers.response_id = " . $resp['response_id']
                                );

                                while ($ans = $answers->fetch_assoc()) {
                                ?>
                                    <div class="question-box">
                                        <strong><?php echo $ans['question_text']; ?></strong>
                                    </div>
                                    <div class="answer-box">
                                        <?php echo $ans['answer']; ?>
                                    </div>
                                <?php } ?>

                            </div>

                    <?php
                        }
                    } else {
                        echo "<div class='alert alert-info'>No responses yet for this form.</div>";
                    }
                    ?>

                </div>

            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>