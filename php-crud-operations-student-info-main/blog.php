<?php 
require "config.php";
include "includes/header.php"; 
?>

<style>
    body {
        background-color: #f5f5f5;
        font-family: 'Arial', sans-serif;
    }
    .container {
        margin-top: 50px;
    }
    .card {
        border: none;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        background: white;
    }
    .card img {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }
    .card-body {
        padding: 20px;
    }
    .card-title {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #333;
    }
    .card-text {
        font-size: 16px;
        color: #555;
    }
    .text-muted {
        font-size: 14px;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">

            <?php
            $query = "SELECT * FROM userdb ORDER BY id DESC"; 
            $query_run = mysqli_query($conn, $query);

            if(mysqli_num_rows($query_run) > 0):
                foreach($query_run as $bloginfo): 
            ?>

            <div class="card">
                <?php if(!empty($bloginfo['image'])): ?>
                    <img src="<?= htmlspecialchars($bloginfo['image']); ?>" class="card-img-top" alt="Post Image">
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($bloginfo['title']); ?></h5>
                    <p class="card-text"><?= nl2br(htmlspecialchars($bloginfo['article'])); ?></p>
                    <p class="card-text"><small class="text-muted">Posted by <?= htmlspecialchars($bloginfo['name']); ?></small></p>
                </div>
            </div>

            <?php 
                endforeach;
            else: 
            ?>
                <div class="alert alert-info text-center">No records found.</div>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>
