<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$form_id = intval($_GET['form_id']);

$form = $conn->query("SELECT * FROM forms WHERE id = $form_id")->fetch_assoc();
$questions = $conn->query("SELECT * FROM questions WHERE form_id = $form_id");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Fill Form | Student Panel</title>
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

        .btn-submit {
            background-color: #764ba2;
            border: none;
        }

        .btn-submit:hover {
            background-color: #5a3e8b;
        }

        .question-box {
            margin-bottom: 25px;
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
            <a href="available_forms.php" class="btn btn-light btn-sm me-2">
                <i class="bi bi-arrow-left"></i> Back
            </a>
            <a href="logout.php" class="btn btn-light btn-sm">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>
    </nav>

    <div class="container mt-5">

        <div class="card card-custom p-4">

            <h3><?php echo htmlspecialchars($form['title']); ?></h3>
            <p class="text-muted"><?php echo htmlspecialchars($form['description']); ?></p>

            <hr>

            <form action="submit_form.php" method="POST">

                <input type="hidden" name="form_id" value="<?php echo $form_id; ?>">

                <?php
                while ($q = $questions->fetch_assoc()) {

                    echo "<div class='question-box'>";
                    echo "<label class='form-label fw-semibold'>" . htmlspecialchars($q['question_text']) . "</label>";

                    if ($q['question_type'] == 'text') {
                        echo "<input type='text' class='form-control' name='answer[" . $q['id'] . "]' required>";
                    } elseif ($q['question_type'] == 'textarea') {
                        echo "<textarea class='form-control' rows='3' name='answer[" . $q['id'] . "]' required></textarea>";
                    } elseif ($q['question_type'] == 'rating') {
                        echo "<select class='form-select' name='answer[" . $q['id'] . "]' required>";
                        echo "<option value=''>Select Rating</option>";
                        for ($i = 1; $i <= 5; $i++) {
                            echo "<option value='$i'>$i</option>";
                        }
                        echo "</select>";
                    } elseif ($q['question_type'] == 'radio') {
                        $options = explode(",", $q['options']);
                        foreach ($options as $opt) {
                            $safeOpt = htmlspecialchars(trim($opt));
                            echo "<div class='form-check'>";
                            echo "<input class='form-check-input' type='radio' 
                              name='answer[" . $q['id'] . "]' value='$safeOpt' required>";
                            echo "<label class='form-check-label'>$safeOpt</label>";
                            echo "</div>";
                        }
                    } elseif ($q['question_type'] == 'select') {
                        $options = explode(",", $q['options']);
                        echo "<select class='form-select' name='answer[" . $q['id'] . "]' required>";
                        echo "<option value=''>Select Option</option>";
                        foreach ($options as $opt) {
                            $safeOpt = htmlspecialchars(trim($opt));
                            echo "<option value='$safeOpt'>$safeOpt</option>";
                        }
                        echo "</select>";
                    }

                    echo "</div>";
                }
                ?>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-submit text-white px-4">
                        <i class="bi bi-check-circle"></i> Submit Feedback
                    </button>
                </div>

            </form>

        </div>

    </div>

</body>

</html>