<?php  
session_start();
require "config.php"; // Database connection

if(isset($_POST['save_user'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $article = mysqli_real_escape_string($conn, $_POST['article']);

    // Handle Image Upload
    $allowed_ext = ['png', 'jpg', 'jpeg', 'gif'];
    $image = "images/default.png"; // Default image if none uploaded

    if (!empty($_FILES['image']['name'])) {
        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_size = $_FILES['image']['size'];

        // Get file extension
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (in_array($file_ext, $allowed_ext)) {
            if ($file_size <= 2000000) { // 2MB limit
                $new_file_name = "images/" . time() . "_" . $file_name; // Unique filename
                move_uploaded_file($file_tmp, $new_file_name);
                $image = $new_file_name; // Set new image path
            } else {
                $_SESSION['message'] = "File size must be less than 2MB!";
                header("Location: user.php");
                exit();
            }
        } else {
            $_SESSION['message'] = "Invalid file type!";
            header("Location: user.php");
            exit();
        }
    }

    // Insert user data into the database
    $query = "INSERT INTO userdb (name, title, article, image) VALUES ('$name', '$title', '$article', '$image')";
    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "User added successfully!";
    } else {
        $_SESSION['message'] = "Database Error: " . mysqli_error($conn);
    }

    header("Location: user.php");
    exit();
}
?>

<?php include "includes/header.php"; ?>

<style>
    /* ---- Global Styles ---- */
    body {
        background-color: #f8f9fa;
        font-family: 'Arial', sans-serif;
    }
    .container {
        margin-top: 40px;
    }
    
    /* ---- Card Styles ---- */
    .card {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        background: #ffffff;
        padding: 20px;
    }

    /* ---- Form Styling ---- */
    .form-control {
        border-radius: 5px;
        border: 1px solid #ced4da;
        padding: 10px;
    }
    .form-control:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: none;
    }
    
    /* ---- Button Styling ---- */
    .btn-primary {
        background-color: #007bff;
        border: none;
        padding: 10px;
        width: 100%;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }

    /* ---- Alert Box ---- */
    .alert {
        border-radius: 5px;
        padding: 10px;
    }

    /* ---- Form Spacing ---- */
    .mb-4 {
        margin-bottom: 20px; /* Increased spacing */
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                
                <h4 class="text-center mb-4">Add New User</h4>

                <!-- Display Messages -->
                <?php if(isset($_SESSION['message'])): ?>
                    <div class="alert alert-warning text-center">
                        <?= $_SESSION['message']; unset($_SESSION['message']); ?>
                    </div>
                <?php endif; ?>
                
                <form action="user.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter full name" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter title" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Article</label>
                        <textarea class="form-control" name="article" rows="3" placeholder="Write article content..." required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Upload Image</label>
                        <input class="form-control" type="file" name="image">
                    </div>
                    <div class="mb-4 text-center">
                        <button type="submit" name="save_user" class="btn btn-primary">Save User</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>

<!-- Bootstrap JavaScript -->
<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
