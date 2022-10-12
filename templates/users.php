<?php include '../includes/header.php'; ?>
<?php require '../NOTviews/users.php' ?>

<div class="container">
 <div class="row my-5 justify-content-end">
    <a href="create-user.php" role="button" class="btn btn-primary">Add user</a>
 </div>

 <div class="row">
    <table class="table">
        <?php if(!empty($actionMsg)): ?>
            <div class="alert <?php echo $actionMsg['msgType']; ?> alert-dismissible fade show" role="alert">
            <strong><?php echo $actionMsg['msgContent']; ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        <?php endif; ?>
        </div>
        <thead class="thead-dark">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Last name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php if(empty($users)): ?>
        <tr>
            <td>
                <?php echo "No users found"; ?>
            </td>
        </tr>
        <?php else: ?>
            <?php foreach($users as $user): ?>
                <tr>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['lastName']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['role']; ?></td>
                    <td class="row" style="margin: 0;">
                        <a href="update-user.php?id=<?php echo $user['id']; ?>" role="button" class="text-warning mx-1">
                                <i class="fas fa-edit"></i>
                        </a>
                        <button class="icon-btn red mx-1 delete_btn" data-toggle="modal" data-target=#deleteUser<?php echo $user['id']; ?>>
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="deleteUser<?php echo $user['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            Are you sure you want to delete user <?php echo $user['name']; ?> <?php echo $user['lastName']; ?>?
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Return</button>
                        <form action="../NOTviews/deleteUser.php?id=<?php echo $user['id']; ?>&role=<?php echo $user['role']; ?>" method="POST">
                            <button role="button" class="btn btn-danger">Delete</button  >
                        </form>
                        </div>
                    </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
     </table>
 </div>      
</div> 

<?php include '../includes/footer.php'; ?>