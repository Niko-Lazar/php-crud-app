<?php include '../includes/header.php'; ?>
<?php require '../NOTviews/students.php' ?>

<div class="container">
    <div class="row my-5 justify-content-end">
        <a href="../templates/create-student.php" role="button" class="btn btn-primary">Create student</a>
    </div>

    <div class="row">
        <table class="table">
            <div class="text-success">
                <?php if(!empty($msg)): ?>
                    <div class="alert <?php echo $msgType; ?> alert-dismissible fade show" role="alert">
                    <strong><?php echo $msg; ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                <?php endif; ?>
            </div>
            <form action="" method="GET">
                <thead class="thead-dark">
                    <tr>
                        <th>Index No.</th>
                        <th scope="col">Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Year of study</th>
                        <th scope="col">ESPB</th>
                        <th scope="col">GPA</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
            </form>
            
            <tbody class="table-striped">
                <?php if(empty($students)): ?>
                    <tr>
                        <td>
                            <?php echo "No students found"; ?>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach($students as $student): ?>
                        <tr>
                            <td><?php echo $student['indexNumber']; ?></td>
                            <td><?php echo $student['name']; ?></td>
                            <td><?php echo $student['lastName']; ?></td>
                            <td><?php echo $student['yearOfStudy']; ?></td>
                            <td><?php echo $student['ESPB']; ?></td>
                            <td><?php echo $student['GPA']; ?></td>
                            <td class="row justify-content-center" style="margin: 0;">
                                <a href="" role="button" class="text-primary mx-1">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="" role="button" class="text-warning mx-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="icon-btn red mx-1 delete_btn" data-toggle="modal" data-target=#deleteStudent<?php echo $student['id']; ?>>
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="deleteStudent<?php echo $student['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        
                                        <div class="modal-body">
                                            Are you sure you want to delete student
                                            index No. <?php echo $student['indexNumber']; ?>
                                            <?php echo $student['name']; ?>
                                            <?php echo $student['lastName']; ?>?
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Return</button>
                                        <form action="../NOTviews/deleteStudent.php?id=<?php echo $student['id']; ?>" method="POST">
                                            <button role="button" class="btn btn-danger">Delete</button  >
                                        </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../includes/footer.php'; ?>