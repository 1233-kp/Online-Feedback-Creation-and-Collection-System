<?php
include 'db.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.html");
    exit();
}

if (isset($_POST['form_id'])) {

    $form_id = intval($_POST['form_id']);

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=form_export.csv');

    $output = fopen("php://output", "w");

    $form = $conn->query("SELECT title FROM forms WHERE id = $form_id")->fetch_assoc();
    fputcsv($output, ["Form Title:", $form['title']]);
    fputcsv($output, []);

    $query = "
        SELECT users.name, questions.question_text, answers.answer
        FROM responses
        JOIN users ON responses.user_id = users.id
        JOIN answers ON answers.response_id = responses.id
        JOIN questions ON questions.id = answers.question_id
        WHERE responses.form_id = $form_id
        ORDER BY users.name
    ";

    $result = $conn->query($query);

    fputcsv($output, ["User Name", "Question", "Answer"]);

    while ($row = $result->fetch_assoc()) {
        fputcsv($output, [
            $row['name'],
            $row['question_text'],
            $row['answer']
        ]);
    }

    fclose($output);
    exit();
}

$forms = $conn->query("SELECT * FROM forms ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Export Data | Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

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

        .btn-export {
            background-color: #1e3c72;
            border: none;
        }

        .btn-export:hover {
            background-color: #2a5298;
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
                <a href="manage_forms.php"><i class="bi bi-folder"></i> Manage Forms</a>
                <a href="view_feedback.php"><i class="bi bi-chat-dots"></i> View Feedback</a>
                <a href="analytics.php"><i class="bi bi-bar-chart"></i> Analytics</a>
                <a href="export.php"><i class="bi bi-download"></i> Export Data</a>
                <a href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
            </div>

            <!-- Main Content -->
            <div class="col-md-10">

                <!-- Header -->
                <div class="header d-flex justify-content-between align-items-center">
                    <h3>Export Form Data</h3>
                    <a href="admin_dashboard.php" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>

                <div class="container mt-4">
                    <div class="card card-custom p-4">

                        <form method="POST">

                            <div class="mb-3">
                                <label class="form-label">Select Form</label>
                                <select name="form_id" class="form-select" required>
                                    <option value="">-- Choose a Form --</option>

                                    <?php while ($form = $forms->fetch_assoc()) { ?>
                                        <option value="<?php echo $form['id']; ?>">
                                            <?php echo htmlspecialchars($form['title']); ?>
                                        </option>
                                    <?php } ?>

                                </select>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-export text-white">
                                    <i class="bi bi-download"></i> Export as CSV
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>

        </div>
    </div>

</body>

</html>