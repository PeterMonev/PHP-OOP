<?php 
session_start();
include('../includes/header.php');


?>

<body>

<div class="container mt-5">
    <h1>Users</h1>
    <?php if ($message): ?>
        <div class="alert alert-info">
            <?= $message; ?>
        </div>
    <?php endif; ?>
    <table class="table">
        <thead>
            <!-- Table Headers... -->
        </thead>
        <tbody>
            <?php foreach($users as $user): ?>
            <tr>
                <td><?= $user->getId() ?></td>
                <td><?= $user->getUsername() ?></td>
                <td><?= $user->getEmail() ?></td>
                <td><?= $user->getRole() ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="id" value="<?= $user->getId() ?>">
                        <input type="text" name="username" value="<?= $user->getUsername() ?>">
                        <input type="email" name="email" value="<?= $user->getEmail() ?>">
                        <select name="role">
                            <option value="user" <?= $user->getRole() === 'user' ? 'selected' : '' ?>>User</option>
                            <option value="admin" <?= $user->getRole() === 'admin' ? 'selected' : '' ?>>Admin</option>
                        </select>
                        <button type="submit" name="edit" class="btn btn-primary">Edit</button>
                        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>