<?php include '../includes/header.php'; ?>
<?php require '../NOTviews/createStudent.php' ?>

<div class="container">
    <div class="row justify-content-start">
        <div class="col-lg-6 cl-xs-12">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <legend class="mt-5 mb-5">Create Student</legend>
                <div class="form-group">
                    <label for="">Index No.</label>
                    <?php if(!empty($studentErrorFields['indexNumber'])): ?>
                        <div class="text-danger">
                            <?php echo $studentErrorFields['indexNumber']; ?>
                        </div>
                    <?php endif; ?>
                    <input type="text" class="form-control" name="indexNumber" required>
                </div>
                <div class="form-group">
                    <label for="">Name</label>
                    <?php if(!empty($studentErrorFields['name'])): ?>
                        <div class="text-danger">
                            <?php echo $studentErrorFields['name']; ?>
                        </div>
                    <?php endif; ?>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group">
                    <label for="">Parent's name</label>
                    <?php if(!empty($studentErrorFields['parentsName'])): ?>
                        <div class="text-danger">
                            <?php echo $studentErrorFields['parentsName']; ?>
                        </div>
                    <?php endif; ?>
                    <input type="text" class="form-control" name="parentsName" required>
                </div>
                <div class="form-group">
                    <label for="">Last name</label>
                    <?php if(!empty($studentErrorFields['lastName'])): ?>
                        <div class="text-danger">
                            <?php echo $studentErrorFields['lastName']; ?>
                        </div>
                    <?php endif; ?>
                    <input type="text"class="form-control" name="lastName" required>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <?php if(!empty($studentErrorFields['indexNumber'])): ?>
                        <div class="text-danger">
                            <?php echo $studentErrorFields['email']; ?>
                        </div>
                    <?php endif; ?>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label for="">Phone number</label>
                    <?php if(!empty($studentErrorFields['phoneNumber'])): ?>
                        <div class="text-danger">
                            <?php echo $studentErrorFields['phoneNumber']; ?>
                        </div>
                    <?php endif; ?>
                    <input type="text" class="form-control" name="phoneNumber" required>
                </div>
                <div class="form-group">
                    <label for="">Year of study</label>
                    <?php if(!empty($studentErrorFields['yearOfStudy'])): ?>
                        <div class="text-danger">
                            <?php echo $studentErrorFields['yearOfStudy']; ?>
                        </div>
                    <?php endif; ?>
                    <input type="text" class="form-control" name="yearOfStudy" required>
                </div>
                <div class="form-group">
                    <label for="">Date of birth</label>
                    <?php if(!empty($studentErrorFields['dateOfBirth'])): ?>
                        <div class="text-danger">
                            <?php echo $studentErrorFields['dateOfBirth']; ?>
                        </div>
                    <?php endif; ?>
                    <input type="date" class="form-control" name="dateOfBirth" required>
                </div>
                <div class="form-group">
                    <label for="">ID number</label>
                    <?php if(!empty($studentErrorFields['IDnumber'])): ?>
                        <div class="text-danger">
                            <?php echo $studentErrorFields['IDnumber']; ?>
                        </div>
                    <?php endif; ?>
                    <input type="text" class="form-control" name="IDnumber" required>
                </div>
                <input type="submit" name="submit" class="btn btn-primary" role="button" value="Create">
            </form>
        </div>
    </div>
</div>