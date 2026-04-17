<?php
include 'db.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.html");
    exit();
}

$title = $_POST['title'];
$description = $_POST['description'];

$conn->query("INSERT INTO forms (title, description) VALUES ('$title', '$description')");

$form_id = $conn->insert_id;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Form Created | Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
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
            text-align: center;
            padding: 40px;
        }

        .success-icon {
            font-size: 60px;
            color: #28a745;
        }

        .btn-custom {
            border-radius: 10px;
            padding: 10px 20px;
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
                <a href="analytics.php"><i class="bi bi-bar-chart"></i> Analytics</a>
                <a href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
            </div>

            <!-- Main Content -->
            <div class="col-md-10">

                <div class="header">
                    <h3>Form Created Successfully</h3>
                </div>

                <div class="container mt-5">
                    <div class="card card-custom">

                        <div class="success-icon mb-3">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>

                        <h4 class="mb-3">Your form has been created successfully 🎉</h4>
                        <p class="text-muted mb-4">
                            You can now start adding questions to this form.
                        </p>

                        <a href="add_question.php?form_id=<?php echo $form_id; ?>"
                            class="btn btn-success btn-custom me-2">
                            <i class="bi bi-plus-circle"></i> Add Questions
                        </a>

                        <a href="admin_dashboard.php"
                            class="btn btn-secondary btn-custom">
                            <i class="bi bi-arrow-left"></i> Back to Dashboard
                        </a>

                    </div>
                </div>

            </div>

        </div>
    </div>

</body>

</html>