<?php
session_start();
require "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student | Student Info</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts & FontAwesome Icons -->
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
        .btn-custom {
            background-color: #007bff;
            color: white;
            transition: 0.3s;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-edit"></i> Edit Student Record
                    <a href="index.php" class="btn btn-light btn-sm float-end">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
                <div class="card-body">
                    <?php
                    if (isset($_GET['id'])) {
                        $student_id = mysqli_real_escape_string($conn, $_GET['id']);

                        $query = "SELECT * FROM students WHERE student_id = '$student_id'";
                        $query_run = mysqli_query($conn, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            $student = mysqli_fetch_assoc($query_run);
                    ?>
                            <form action="functions.php" method="POST">
                                <input type="hidden" name="student_id" value="<?= $student['student_id']; ?>">

                                <div class="mb-3">
                                    <label class="form-label">First Name</label>
                                    <input type="text" name="first_name" value="<?= htmlspecialchars($student['first_name']); ?>" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" name="last_name" value="<?= htmlspecialchars($student['last_name']); ?>" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" value="<?= htmlspecialchars($student['email']); ?>" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" value="<?= htmlspecialchars($student['phone']); ?>" class="form-control" pattern="0{1}[0-9]{10}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Course</label>
                                    <input type="text" name="course" value="<?= htmlspecialchars($student['course']); ?>" class="form-control" required>
                                </div>

                                <div class="mb-3 text-center">
                                    <button type="submit" name="update_record" class="btn btn-custom btn-lg w-100">Update Record</button>
                                </div>
                            </form>
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
