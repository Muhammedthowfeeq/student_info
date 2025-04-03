<?php
// Include database connection
require "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Student | Student Info</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border: none;
        }
        .card-header {
            background: linear-gradient(to right, #007bff, #0056b3);
            color: white;
            font-size: 18px;
            font-weight: bold;
            padding: 15px 20px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .info-label {
            font-weight: bold;
            color: #333;
        }
        .info-value {
            font-size: 18px;
            font-weight: 500;
            color: #555;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-user"></i> Student Details
                    <a href="index.php" class="btn btn-light btn-sm float-end">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
                <div class="card-body">
                    <?php
                    // Check if ID is set in URL
                    if (isset($_GET['id'])) {
                        $student_id = mysqli_real_escape_string($conn, $_GET['id']);
                        
                        // Fetch student details
                        $query = "SELECT * FROM students WHERE student_id = '$student_id'";
                        $query_run = mysqli_query($conn, $query);

                        // If record exists
                        if (mysqli_num_rows($query_run) > 0) {
                            $student = mysqli_fetch_assoc($query_run);
                    ?>
                            <div class="mb-3">
                                <span class="info-label">First Name:</span>
                                <p class="info-value"><?= $student['first_name']; ?></p>
                            </div>
                            <div class="mb-3">
                                <span class="info-label">Last Name:</span>
                                <p class="info-value"><?= $student['last_name']; ?></p>
                            </div>
                            <div class="mb-3">
                                <span class="info-label">Email:</span>
                                <p class="info-value"><?= $student['email']; ?></p>
                            </div>
                            <div class="mb-3">
                                <span class="info-label">Phone:</span>
                                <p class="info-value"><?= $student['phone']; ?></p>
                            </div>
                            <div class="mb-3">
                                <span class="info-label">Course:</span>
                                <p class="info-value"><?= $student['course']; ?></p>
                            </div>
                    <?php
                        } else {
                            echo "<div class='alert alert-danger text-center'>Student ID not found!</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger text-center'>Invalid request!</div>";
                    }
                    ?>
                </div>
            </div>    
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>    

</body>
</html>
