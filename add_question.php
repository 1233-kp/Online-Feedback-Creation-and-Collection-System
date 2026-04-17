<?php
include 'db.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.html");
    exit();
}

$form_id = $_GET['form_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Question | Admin Panel</title>
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

        .form-control,
        .form-select {
            border-radius: 10px;
            padding: 10px;
        }

        .btn-custom {
            background-color: #1e3c72;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
        }

        .btn-custom:hover {
            background-color: #2a5298;
        }

        .note-text {
            font-size: 13px;
            color: #6c757d;
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
                    <h3>Add Question to Form</h3>
                    <a href="manage_forms.php" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>

                <!-- Form Card -->
                <div class="container mt-4">
                    <div class="card card-custom p-4">

                        <form action="save_question.php" method="POST">

                            <input type="hidden" name="form_id" value="<?php echo $form_id; ?>">

                            <div class="mb-3">
                                <label class="form-label">Question Text</label>
                                <input type="text" name="question_text" class="form-control"
                                    placeholder="Enter your question here..." required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Question Type</label>
                                <select name="question_type" class="form-select" required>
                                    <option value="">-- Select Type --</option>
                                    <option value="text">Text (Short Answer)</option>
                                    <option value="textarea">Textarea (Long Answer)</option>
                                    <option value="rating">Rating (1-5)</option>
                                    <option value="radio">Radio (Multiple Choice)</option>
                                    <option value="select">Dropdown</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Options (For Radio/Dropdown)</label>
                                <input type="text" name="options" class="form-control"
                                    placeholder="Enter options like: Yes, No">

                                <small class="text-muted">
                                    ⚠️ Required only for Radio & Dropdown (comma separated)
                                </small>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-custom text-white">
                                    <i class="bi bi-plus-circle"></i> Add Question
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>