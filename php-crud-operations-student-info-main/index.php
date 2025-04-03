<?php
session_start();
require "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Info | Dashboard</title>

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
        .table th {
            background-color: #007bff;
            color: white;
            text-align: center;
        }
        .table tbody tr {
            transition: 0.3s;
        }
        .table tbody tr:hover {
            background-color: #eef4ff;
            cursor: pointer;
        }
        .btn-custom {
            border-radius: 5px;
            font-size: 14px;
            padding: 6px 10px;
        }
        .no-record {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            color: #ff4d4d;
            padding: 20px;
        }
        /* Responsive */
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <?php include "message.php"; ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-user-graduate"></i> Student Information
                    <a href="create.php" class="btn btn-light btn-sm float-end">
                        <i class="fas fa-plus-circle"></i> Add Student
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Course</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM students";
                                $query_run = mysqli_query($conn, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $student) {
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $student['student_id']?></td>
                                            <td><?= htmlspecialchars($student['first_name'])?></td>
                                            <td><?= htmlspecialchars($student['last_name'])?></td>
                                            <td><?= htmlspecialchars($student['email'])?></td>
                                            <td><?= htmlspecialchars($student['phone'])?></td>
                                            <td><?= htmlspecialchars($student['course'])?></td>
                                            <td class="text-center">
                                                <a href="view.php?id=<?= $student['student_id']; ?>" class="btn btn-info btn-sm btn-custom">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                                <a href="edit.php?id=<?= $student['student_id']; ?>" class="btn btn-success btn-sm btn-custom">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="functions.php" method="POST" class="d-inline">
                                                    <button type="submit" name="delete-student" value="<?= $student['student_id']; ?>" 
                                                        class="btn btn-danger btn-sm btn-custom" onclick="return confirm('Are you sure you want to delete this student?');">
                                                        <i class="fas fa-trash-alt"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='7' class='no-record'>No records found.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
