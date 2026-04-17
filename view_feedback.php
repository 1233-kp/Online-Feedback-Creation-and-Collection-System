<?php
include 'db.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.html");
    exit();
}

$sql = "SELECT feedback.id, users.name, feedback.teacher_rating, 
        feedback.teaching_quality, feedback.infrastructure_rating, 
        feedback.suggestion, feedback.status
        FROM feedback 
        JOIN users ON feedback.user_id = users.id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Feedback | Admin Panel</title>
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

        .badge-pending {
            background-color: #ffc107;
            color: black;
        }

        .badge-reviewed {
            background-color: #28a745;
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
                <a href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
            </div>

            <!-- Main Content -->
            <div class="col-md-10">

                <!-- Header -->
                <div class="header d-flex justify-content-between align-items-center">
                    <h3>All Feedback</h3>
                    <a href="admin_dashboard.php" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>

                <div class="container mt-4">
                    <div class="card card-custom p-4">

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Name</th>
                                        <th>Teacher Rating</th>
                                        <th>Quality</th>
                                        <th>Infrastructure</th>
                                        <th>Suggestion</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php while ($row = $result->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['teacher_rating']); ?></td>
                                            <td><?php echo htmlspecialchars($row['teaching_quality']); ?></td>
                                            <td><?php echo htmlspecialchars($row['infrastructure_rating']); ?></td>
                                            <td><?php echo htmlspecialchars($row['suggestion']); ?></td>

                                            <td>
                                                <?php if ($row['status'] == 'Reviewed') { ?>
                                                    <span class="badge badge-reviewed">
                                                        Reviewed
                                                    </span>
                                                <?php } else { ?>
                                                    <span class="badge badge-pending">
                                                        Pending
                                                    </span>
                                                <?php } ?>
                                            </td>

                                            <td class="text-center">
                                                <a href="update_status.php?id=<?php echo $row['id']; ?>"
                                                    class="btn btn-sm btn-success me-1">
                                                    <i class="bi bi-check-circle"></i>
                                                </a>

                                                <a href="delete_feedback.php?id=<?php echo $row['id']; ?>"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Delete this feedback?')">
                                                    <i class="bi bi-trash"></i>
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

</body>

</html>