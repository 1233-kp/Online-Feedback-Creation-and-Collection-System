<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$sql = "SELECT * FROM forms ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Available Forms | Student Panel</title>
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

        .btn-fill {
            background-color: #764ba2;
            border: none;
        }

        .btn-fill:hover {
            background-color: #5a3e8b;
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
            <a href="user_dashboard.php" class="btn btn-light btn-sm me-2">
                <i class="bi bi-arrow-left"></i> Dashboard
            </a>
            <a href="logout.php" class="btn btn-light btn-sm">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>
    </nav>

    <div class="container mt-5">

        <div class="mb-4">
            <h3>Available Feedback Forms</h3>
            <p class="text-muted">Select a form below to submit your feedback.</p>
        </div>

        <div class="row g-4">

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <div class="col-md-4">
                        <div class="card card-custom p-4 h-100">
                            <h5><?php echo htmlspecialchars($row['title']); ?></h5>
                            <p class="text-muted">
                                <?php echo htmlspecialchars($row['description']); ?>
                            </p>

                            <div class="mt-auto">
                                <a href="fill_form.php?form_id=<?php echo $row['id']; ?>"
                                    class="btn btn-fill text-white w-100">
                                    <i class="bi bi-pencil-square"></i> Fill This Form
                                </a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<div class='alert alert-info'>No forms available at the moment.</div>";
            }
            ?>

        </div>

    </div>

</body>

</html>