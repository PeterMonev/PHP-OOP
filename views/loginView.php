<?php
include('../includes/header.php');
session_start();
?>

<body>

    <div class="container mt-5 w-50 p-5 text-center shadow-lg rounded">

        <?php
          include('../includes/alertMessage.php');
        ?>

        <h2 class="mb-4">Login</h2>
        <form action="../controllers/AuthenticationController.php" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" id="email" >
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" id="password" >
            </div>
            <button type="submit" name="login" class="btn btn-info">Login</button>
            <div class="form-group my-3">
                <label for="route">You already don't have account? Go to Sign Up.</label>
                <a href="../views/registerView.php" class="pb-4">Register</a>
            </div>
        </form>
    </div>

</body>