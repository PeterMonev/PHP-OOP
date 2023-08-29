<?php include('../includes/authentication.php');?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <!-- Bootstrap JS and jQuery -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

</head>

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center bg-dark">
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
            <?php
                if (!isRoleUser() && !isRoleAdmin()) {
                    //  Links for guests
                    echo '
                    <li class="nav-item">
                      <a class="nav-link text-info" href="../views/loginView.php">Login</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-info" href="../views/registerView.php">Register</a>
                    </li>';
                } else {
                    // Link for logout
                    echo '
                    <li class="nav-item">
                       <a class="nav-link text-info" href="../controllers/AuthenticationController.php?action=logout">Logout</a>
                    </li>';

                    // Links for users
                    if (isRoleUser() && !isRoleAdmin()) {
                        echo '
                        <li class="nav-item">
                           <a class="nav-link text-info" href="../views/profileView.php">Profile</a>
                        </li>';
                    }
                    
                    //  Links for admin
                    if (isRoleAdmin()) {
                        echo '
                        <li class="nav-item">
                           <a class="nav-link text-info" href="admin.php">Admin</a>
                        </li>';
                    }
                }
                ?>
            </ul>
        </div>
    </nav>
</header>