<?php include '../includes/header.php'; ?>
<?php require '../views/createSubject.php' ?>

<div class="container">
    <div class="row justify-content-start">
        <div class="col-lg-6 cl-xs-12">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <legend class="mt-5 mb-5">Create subject</legend>
                <div class="form-group">
                    <label for="">Subject code</label>
                    <?php if(!empty($subjectCodeErr)): ?>
                        <div class="text-danger">
                            <?php echo $subjectCodeErr; ?>
                        </div>
                    <?php endif; ?>
                    <input type="text" class="form-control" name="subjectCode" required>
                </div>
                <div class="form-group">
                    <label for="">Subject name</label>
                    <?php if(!empty($nameErr)): ?>
                        <div class="text-danger">
                            <?php echo $nameErr; ?>
                        </div>
                    <?php endif; ?>
                    <input type="text" class="form-control" name="name" required>
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
                    <label for="">ESPB</label>
                    <?php if(!empty($ESPBErr)): ?>
                        <div class="text-danger">
                            <?php echo $ESPBErr; ?>
                        </div>
                    <?php endif; ?>
                    <input type="text" class="form-control" name="ESPB" required>
                </div>
                <div class="form-group">
                    <label for="">Mandatory</label>
                    <?php if(!empty($mandatoryErr)): ?>
                        <div class="text-danger">
                            <?php echo $mandatoryErr; ?>
                        </div>
                    <?php endif; ?>
                    <select name="mandatory" class="custom-select">
                        <option value="">Type</option>
                        <option value="0">Optional</option>
                        <option value="1">Mandatory</option>
                    </select>
                </div>
                <input type="submit" name="submit" class="btn btn-primary" role="button" value="Create">
            </form>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>