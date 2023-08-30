<?php
session_start();
include('../includes/header.php');
require('../controllers/UserManagementController.php');

$controller = new UserManagementController();
$users = $controller->getAllUsers();


if (!isRoleUser() || !isRoleAdmin()) {
  header('Location: ../views/loginView.php');
  exit;
}

?>

<div class="container mt-5 shadow-lg rounded p-5">
  <?php
  include('../includes/alertMessage.php');
  ?>
  <h1 class=" text-center ">Admin Panel</h1>
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
      <?php foreach ($users as $user) : ?>
        <tr>
          <td><?php echo $user['id']; ?></td>
          <td><?php echo $user['username']; ?></td>
          <td><?php echo $user['email']; ?></td>
          <td><?php echo $user['role']; ?></td>
          <td>
            <button data-id="<?php echo $user['id']; ?>" class="btn btn-info editUser" data-toggle="modal" data-target="#editUserModal">Edit</button>
            <button data-id="<?php echo $user['id']; ?>" class="btn btn-danger deleteUser" data-toggle="modal" data-target="#deleteModal">Delete</button>

          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <!-- Edit User Modal -->
  <div class="modal" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editUserLabel">Edit User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="../controllers/UserManagementController.php" method="post">
          <div class="modal-body">
            <input type="hidden" name="editUserId" id="editUserId">
            <div class="form-group">
              <label for="editUsername">Username</label>
              <input type="text" class="form-control" id="editUsername" name="editUsername">
            </div>
            <div class="form-group">
              <label for="editEmail">Email</label>
              <input type="email" class="form-control" id="editEmail" name="editEmail">
            </div>
            <div class="form-group">
              <label for="editRole">Role</label>
              <select class="form-control" id="editRole" name="editRole">
                <option value="admin">Admin</option>
                <option value="user">User</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="edit">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>


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
  <script>
    $(document).ready(function() {
      $('.editUser').on('click', function() {
        const userId = $(this).data('id');
        const username = $(this).closest('tr').find('td:eq(1)').text();
        const email = $(this).closest('tr').find('td:eq(2)').text();
        const role = $(this).closest('tr').find('td:eq(3)').text();

        $('#editUserId').val(userId);
        $('#editUsername').val(username);
        $('#editEmail').val(email);
        $('#editRole').val(role);
      });
    });
  </script>

</div>