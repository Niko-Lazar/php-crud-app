<?php include '../includes/header.php'; ?>
<?php require '../NOTviews/subjects.php' ?>

<div class="container">
    <div class="row my-5 justify-content-end">
        <a href="../templates/create-subject.php" role="button" class="btn btn-primary">Create subject</a>
    </div>

    <div class="row">
        <table class="table">
                <?php if(!empty($actionMsg)): ?>
                    <div class="alert <?php echo $actionMsg['msgType']; ?> alert-dismissible fade show" role="alert">
                    <strong><?php echo $actionMsg['msgContent']; ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                <?php endif; ?>
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Subject code</th>
                    <th scope="col">Subject name</th>
                    <th scope="col">Year of study</th>
                    <th scope="col">ESPB</th>
                    <th scope="col">Type</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="table-striped">
                <?php if(empty($subjects)): ?>
                    <tr>
                        <td>
                            <?php echo "No subjects found"; ?>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach($subjects as $subject): ?>
                        <tr>
                            <td><?php echo $subject['subjectCode'] ?></td>
                            <td><?php echo $subject['name'] ?></td>
                            <td><?php echo $subject['yearOfStudy'] ?></td>
                            <td><?php echo $subject['ESPB'] ?></td>
                            <td>
                                <?php if($subject['mandatory']): ?>
                                    Mandatory
                                <?php else: ?>
                                    Optional
                                <?php endif; ?>
                            </td>
                            <td class="row" style="margin: 0;">
                                <form action="" method="POST">
                                    <a href="update-subject.php?id=<?php echo $subject['id']; ?>" role="button" class="text-warning mx-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </form>
                                <button class="icon-btn red mx-1 delete_btn" data-toggle="modal" data-target=#deleteSubject<?php echo $subject['id'] ?>>
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="deleteSubject<?php echo $subject['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">
                                    Are you sure you want to delete subject <?php echo $subject['subjectCode'] ?> <?php echo $subject['name'] ?>?
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Return</button>
                                <form action="../NOTviews/deleteSubject.php?id=<?php echo $subject['id']; ?>" method="POST">
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