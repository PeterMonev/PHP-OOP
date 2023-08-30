<?php 
    session_start();
    include('../includes/header.php');
    require('../controllers/UserManagementController.php'); 

    $controller = new UserManagementController();
    $users = $controller->getAllUsers();
    
?>

<div class="container mt-5">
    
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['role']; ?></td>
                    <td>
                        <button data-id="<?php echo $user['id']; ?>" class="btn btn-primary editUser" data-toggle="modal" data-target="#editUserModal">Edit</button>
                        <button data-id="<?php echo $user['id']; ?>" class="btn btn-danger deleteUser" data-toggle="modal" data-target="#deleteModal">Delete</button>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Delete Confirmation Modal -->
    <div class="modal" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this user?
            </div>
            <div class="modal-footer">
                <form action="../controllers/UserManagementController.php" method="get">
                    <input type="hidden" name="delete" id="userIdToDelete" value="">
                    <a href="../controllers/UserManagementController.php?delete=<?= $user['id'] ?>" class="btn btn-danger" name="delete">Delete</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>


</div>
