<?php include '../includes/header.php'; ?>
<?php require '../NOTviews/student.php' ?>

<div class="container">
    <div class="row">
        <div class="col-6 mt-5">
            <table class="table">
                <tbody>
                    <tr>
                        <th scope="row">Name</th>
                        <td><?php echo $student['name']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Parents name</th>
                        <td><?php echo $student['parentsName']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Last name</th>
                        <td><?php echo $student['lastName']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Index number</th>
                        <td><?php echo $student['indexNumber']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Phone number</th>
                        <td><?php echo $student['phoneNumber']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Email</th>
                        <td><?php echo $student['email']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Date of birth</th>
                        <td><?php echo $student['dateOfBirth']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">ID number</th>
                        <td><?php echo $student['IDNumber']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">total ESPB</th>
                        <td><?php echo $student['ESPB']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">GPA</th>
                        <td><?php echo $student['GPA']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Action</th>
                        <td class="">
                            <a href="update-student.php?id=<?php echo $student['id']; ?>" role="button" class="text-warning mx-1">
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
                </tbody>
            </table>
        </div>
        <div class="col-6 mt-5">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?id=$studentID"; ?>" method="POST">
            
                <?php if(isset($_SESSION['flash_message'])): ?>
                        <div class="alert <?php echo $_SESSION['flash_message']['msgType']; ?> alert-dismissible fade show" role="alert">
                            <strong>
                                <?php
                                    echo $_SESSION['flash_message']['msgContent'];
                                    unset($_SESSION['flash_message']);
                                    ?>
                            </strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                    <?php endif; ?>

                <div class="form-group">
                    <label for="">Subject</label>
                    <select name="subjectID"class="custom-select">
                        <?php if(!empty($gradesErrorFields['subjectID'])): ?>
                            <div class="text-danger">
                                <?php echo $gradesErrorFields['subjectID']; ?>
                            </div>
                        <?php endif; ?>
                        <option value="" selected>Select subject</option>
                        <?php foreach($subjects as $subject): ?>
                            <option value="<?php echo $subject['id']; ?>">
                                <?php echo $subject['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Grade</label>
                    
                        <?php if(!empty($gradesErrorFields['grade'])): ?>
                            <div class="text-danger">
                                <?php echo $gradesErrorFields['grade']; ?>
                            </div>
                        <?php endif; ?>
                    <input type="text" name="grade" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Date</label>
                        <?php if(!empty($gradesErrorFields['date'])): ?>
                            <div class="text-danger">
                                <?php echo $gradesErrorFields['date']; ?>
                            </div>
                        <?php endif; ?>
                    <input type="date" name="date" class="form-control" required>
                </div>
                <div class="d-flex align-items-center justify-content-center">
                    <input type="submit" name="submit" class="btn btn-primary" role="button" value="Grade student">
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <table class="table">

            <thead class="thead-dark">
                <tr>
                    <th scope="col">Subject code</th>
                    <th scope="col">Subject name</th>
                    <th scope="col">Year of study</th>
                    <th scope="col">ESPB</th>
                    <th scope="col">Type</th>
                    <th>Grade</th>
                    <th>Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody class="table-striped">
                <?php foreach($grades as $grade): ?>
                    <tr>
                    <td><?php echo $grade['subjectCode']; ?></td>
                    <td><?php echo $grade['name']; ?></td>
                    <td><?php echo $grade['yearOfStudy']; ?></td>
                    <td><?php echo $grade['ESPB']; ?></td>
                    <td>
                        <?php if($grade['mandatory'] == '0'): ?>
                            Optional
                        <?php else: ?>
                            Mandatory
                        <?php endif; ?>
                    </td>
                    <td><?php echo $grade['grade']; ?></td>
                    <td><?php echo $grade['date']; ?></td>
                    <td class="row" style="margin: 0;">
                        <form action="" method="POST">
                            <a href="" role="button" class="text-warning mx-1">
                                <i class="fas fa-edit"></i>
                            </a>
                        </form>
                        <button class="icon-btn red mx-1 delete_btn" data-toggle="modal" data-target=#deleteGrade<?php echo $grade['id']; ?>>
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="deleteGrade<?php echo $grade['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                Are you sure you want to delete grade <?php echo $grade['grade']; ?> for subject <?php echo $grade['name']; ?>?
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Return</button>
                            <form action="../NOTviews/deleteGrade.php?student=<?php echo $grade['studentID']; ?>&subject=<?php echo $grade['subjectID']; ?>" method="POST">
                                <button role="button" class="btn btn-danger">Delete</button>
                            </form>
                            </div>
                        </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
