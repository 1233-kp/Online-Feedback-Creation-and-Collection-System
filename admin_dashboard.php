<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | Feedback System</title>
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

        .dashboard-header {
            padding: 20px;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .card-custom {
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: 0.3s;
        }

        .card-custom:hover {
            transform: translateY(-5px);
        }

        .logout-btn {
            background-color: #dc3545;
            border: none;
        }

        .logout-btn:hover {
            background-color: #bb2d3b;
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

                <!-- Top Header -->
                <div class="dashboard-header d-flex justify-content-between align-items-center">
                    <h3>Welcome, Admin 👋</h3>
                    <a href="logout.php" class="btn logout-btn text-white">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </div>

                <!-- Dashboard Cards -->
                <div class="container mt-4">
                    <div class="row g-4">

                        <div class="col-md-4">
                            <div class="card card-custom p-4 text-center">
                                <i class="bi bi-plus-circle fs-1 text-primary"></i>
                                <h5 class="mt-3">Create New Form</h5>
                                <a href="create_form.php" class="btn btn-primary mt-2">Go</a>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card card-custom p-4 text-center">
                                <i class="bi bi-folder fs-1 text-success"></i>
                                <h5 class="mt-3">Manage Forms</h5>
                                <a href="manage_forms.php" class="btn btn-success mt-2">Go</a>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card card-custom p-4 text-center">
                                <i class="bi bi-chat-dots fs-1 text-warning"></i>
                                <h5 class="mt-3">View Feedback</h5>
                                <a href="view_feedback.php" class="btn btn-warning mt-2 text-white">Go</a>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card card-custom p-4 text-center">
                                <i class="bi bi-list-check fs-1 text-info"></i>
                                <h5 class="mt-3">View Responses</h5>
                                <a href="view_responses.php" class="btn btn-info mt-2 text-white">Go</a>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card card-custom p-4 text-center">
                                <i class="bi bi-bar-chart fs-1 text-danger"></i>
                                <h5 class="mt-3">Analytics</h5>
                                <a href="analytics.php" class="btn btn-danger mt-2">Go</a>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card card-custom p-4 text-center">
                                <i class="bi bi-download fs-1 text-secondary"></i>
                                <h5 class="mt-3">Export Data</h5>
                                <a href="export.php" class="btn btn-secondary mt-2">Download</a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>