<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : "Student";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Dashboard | Feedback System</title>
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

        .navbar-custom {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: white !important;
        }

        .card-custom {
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: 0.3s;
        }

        .card-custom:hover {
            transform: translateY(-5px);
        }

        .btn-custom {
            background-color: #764ba2;
            border: none;
        }

        .btn-custom:hover {
            background-color: #5a3e8b;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom px-4">
        <a class="navbar-brand" href="#">
            <i class="bi bi-mortarboard-fill"></i> Student Panel
        </a>
        <div class="ms-auto">
            <a href="logout.php" class="btn btn-light btn-sm">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">

        <div class="mb-4">
            <h3>Welcome, <?php echo htmlspecialchars($user_name); ?> 👋</h3>
            <p class="text-muted">Manage your feedback submissions from here.</p>
        </div>

        <div class="row g-4">

            <!-- Fill Forms Card -->
            <div class="col-md-6">
                <div class="card card-custom p-4 text-center">
                    <i class="bi bi-pencil-square fs-1 text-primary"></i>
                    <h5 class="mt-3">Fill Available Forms</h5>
                    <p class="text-muted">Submit your feedback for active forms.</p>
                    <a href="available_forms.php" class="btn btn-custom text-white mt-2">
                        Go to Forms
                    </a>
                </div>
            </div>

            <!-- View History Card -->
            <div class="col-md-6">
                <div class="card card-custom p-4 text-center">
                    <i class="bi bi-clock-history fs-1 text-success"></i>
                    <h5 class="mt-3">View My Feedback</h5>
                    <p class="text-muted">Check your previous submissions.</p>
                    <a href="user_history.php" class="btn btn-success mt-2">
                        View History
                    </a>
                </div>
            </div>

        </div>

    </div>

</body>

</html>