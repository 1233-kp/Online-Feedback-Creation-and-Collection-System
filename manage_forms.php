<?php
include 'db.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.html");
    exit();
}

$forms = $conn->query("SELECT * FROM forms ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Forms | Admin Panel</title>
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

        .table th {
            background-color: #1e3c72;
            color: white;
        }

        .action-btn {
            margin-right: 5px;
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
                    <h3>Manage Forms</h3>
                    <a href="admin_dashboard.php" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>

                <div class="container mt-4">
                    <div class="card card-custom p-4">

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Created At</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php while ($form = $forms->fetch_assoc()) { ?>
                                        <tr>
                                            <td><strong><?php echo $form['title']; ?></strong></td>
                                            <td><?php echo $form['description']; ?></td>
                                            <td><?php echo $form['created_at']; ?></td>
                                            <td class="text-center">

                                                <a href="add_question.php?form_id=<?php echo $form['id']; ?>"
                                                    class="btn btn-sm btn-primary action-btn">
                                                    <i class="bi bi-plus-circle"></i> Add
                                                </a>

                                                <a href="view_form_details.php?form_id=<?php echo $form['id']; ?>"
                                                    class="btn btn-sm btn-info text-white action-btn">
                                                    <i class="bi bi-eye"></i> View
                                                </a>

                                                <a href="delete_form.php?form_id=<?php echo $form['id']; ?>"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this form?')">
                                                    <i class="bi bi-trash"></i> Delete
                                                </a>

                                            </td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>