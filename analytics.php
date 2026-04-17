<?php
include 'db.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.html");
    exit();
}

$sql = "SELECT 
        AVG(teacher_rating) AS avg_teacher,
        AVG(infrastructure_rating) AS avg_infra
        FROM feedback";

$result = $conn->query($sql);
$data = $result->fetch_assoc();

$avg_teacher = round($data['avg_teacher'], 2);
$avg_infra = round($data['avg_infra'], 2);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Analytics | Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

        .stat-card {
            text-align: center;
            padding: 20px;
        }

        .stat-number {
            font-size: 32px;
            font-weight: 600;
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
                    <h3>Feedback Analytics</h3>
                    <a href="admin_dashboard.php" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>

                <div class="container mt-4">

                    <!-- Statistics Cards -->
                    <div class="row g-4 mb-4">

                        <div class="col-md-6">
                            <div class="card card-custom stat-card">
                                <i class="bi bi-person-check fs-1 text-primary"></i>
                                <h5 class="mt-3">Average Teacher Rating</h5>
                                <div class="stat-number text-primary">
                                    <?php echo $avg_teacher ?: 0; ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card card-custom stat-card">
                                <i class="bi bi-building fs-1 text-success"></i>
                                <h5 class="mt-3">Average Infrastructure Rating</h5>
                                <div class="stat-number text-success">
                                    <?php echo $avg_infra ?: 0; ?>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Chart Card -->
                    <div class="card card-custom p-4">
                        <h5 class="mb-4">Ratings Overview</h5>
                        <canvas id="myChart"></canvas>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Teacher Rating', 'Infrastructure Rating'],
                datasets: [{
                    label: 'Average Ratings',
                    data: [<?php echo $avg_teacher ?: 0; ?>,
                        <?php echo $avg_infra ?: 0; ?>
                    ],
                    backgroundColor: ['#1e3c72', '#28a745']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 5
                    }
                }
            }
        });
    </script>

</body>

</html>