<?php
include('../includes/header.php');
session_start();
?>


<body>

    <div class="container mt-5 w-50 text-center shadow-lg rounded p-5">

        <?php
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        ?>

        <h2 class="mb-4">Registration Form</h2>
        <form action="../controllers/AuthenticationController.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" id="username" >
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" id="password" >
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" id="email" >
            </div>
            <button type="submit" name="register" class="btn btn-info">Register</button>
            <div class="form-group mt-3">
                <label for="route">You already have an account? Go to login.</label>
                <a href="../views/loginView.php">Login</a>
            </div>
        </form>
    </div>

</body>