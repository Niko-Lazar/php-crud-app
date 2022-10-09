<?php include '../includes/header.php'; ?>
<?php require '../views/createStudent.php' ?>

<div class="container">
    <div class="row justify-content-start">
        <div class="col-lg-6 cl-xs-12">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <legend class="mt-5 mb-5">Create Student</legend>
                <div class="form-group">
                    <label for="">Index No.</label>
                    <?php if(!empty($indexNumberErr)): ?>
                        <div class="text-danger">
                            <?php echo $indexNumberErr; ?>
                        </div>
                    <?php endif; ?>
                    <input type="text" class="form-control" name="indexNumber" required>
                </div>
                <div class="form-group">
                    <label for="">Name</label>
                    <?php if(!empty($nameErr)): ?>
                        <div class="text-danger">
                            <?php echo $nameErr; ?>
                        </div>
                    <?php endif; ?>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group">
                    <label for="">Parent's name</label>
                    <?php if(!empty($parentsNameErr)): ?>
                        <div class="text-danger">
                            <?php echo $parentsNameErr; ?>
                        </div>
                    <?php endif; ?>
                    <input type="text" class="form-control" name="parentsName" required>
                </div>
                <div class="form-group">
                    <label for="">Last name</label>
                    <?php if(!empty($lastNameErr)): ?>
                        <div class="text-danger">
                            <?php echo $lastNameErr; ?>
                        </div>
                    <?php endif; ?>
                    <input type="text"class="form-control" name="lastName" required>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <?php if(!empty($emailErr)): ?>
                        <div class="text-danger">
                            <?php echo $emailErr; ?>
                        </div>
                    <?php endif; ?>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label for="">Phone number</label>
                    <?php if(!empty($phoneNumberErr)): ?>
                        <div class="text-danger">
                            <?php echo $phoneNumberErr; ?>
                        </div>
                    <?php endif; ?>
                    <input type="text" class="form-control" name="phoneNumber" required>
                </div>
                <div class="form-group">
                    <label for="">Year of study</label>
                    <?php if(!empty($yearOfStudyErr)): ?>
                        <div class="text-danger">
                            <?php echo $yearOfStudyErr; ?>
                        </div>
                    <?php endif; ?>
                    <input type="text" class="form-control" name="yearOfStudy" required>
                </div>
                <div class="form-group">
                    <label for="">Date of birth</label>
                    <?php if(!empty($dateOfBirthErr)): ?>
                        <div class="text-danger">
                            <?php echo $dateOfBirthErr; ?>
                        </div>
                    <?php endif; ?>
                    <input type="date" class="form-control" name="dateOfBirth" required>
                </div>
                <div class="form-group">
                    <label for="">ID number</label>
                    <?php if(!empty($IDnumberErr)): ?>
                        <div class="text-danger">
                            <?php echo $IDnumberErr; ?>
                        </div>
                    <?php endif; ?>
                    <input type="text" class="form-control" name="IDnumber" required>
                </div>
                <input type="submit" name="submit" class="btn btn-primary" role="button" value="Create">
            </form>
        </div>
    </div>
</div>