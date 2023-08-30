<?php
session_start();
include('../includes/header.php');

require_once '../models/Database.php';
require_once '../models/User.php';
require_once '../models/UserManagement.php';

$userManagement = new UserManagement();
$user = null;

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $user = $userManagement->readUser($userId);
}

if (!isRoleUser() || isRoleAdmin()) {
    header('Location: ../views/loginView.php');
    exit;
}
?>

<body>
<div class="container mt-5 shadow-lg p-5 rounded">
    <div class="card">
        <div class="card-header text-center">
            <h3>Profile Page Information</h3>
        </div>
        <div class="card-body">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <p class="card-title">Name: <b><?php echo $user['username']; ?></b></p>
            <p class="card-text">Email: <b><?php echo $user['email']; ?></b></p>
            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#updateProfileModal">Update Profile</a>
        </div>
    </div>
</div>

<div class="modal fade " id="updateProfileModal" tabindex="-1" aria-labelledby="updateProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateProfileModalLabel">Update Profile</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="../controllers/UserManagementController.php" method="post">
                    <input type="hidden" name="updateUserId" value="<?php echo $user['id']; ?>">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" name="update" class="btn btn-success">Update changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
