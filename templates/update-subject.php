<?php include '../includes/header.php'; ?>
<?php require '../views/updateSubject.php' ?>

<div class="container">
            <div class="row justify-content-start">
                <div class="col-lg-6 cl-xs-12">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=$subjectID"; ?>" method="POST">
                        <legend class="mt-5 mb-5">Update subject</legend>
                        <div class="form-group">
                            <label for="">Subject code</label>
                            <input type="text" class="form-control" name="subjectCode"
                            value = "<?php echo $subject['subjectCode']; ?>"
                            required>
                        </div>
                        <div class="form-group">
                            <label for="">Subject name</label>
                            <input type="text"class="form-control" name="name"
                            value = "<?php echo $subject['name']; ?>"
                            required>
                        </div>
                        <div class="form-group">
                            <label for="">Year of Study</label>
                            <input type="text"class="form-control" name="yearOfStudy"
                            value = "<?php echo $subject['yearOfStudy']; ?>"
                            required>
                        </div>
                        <div class="form-group">
                            <label for="">ESPB</label>
                            <input type="text" class="form-control" name="ESPB"
                            value = "<?php echo $subject['ESPB']; ?>"
                            required>
                        </div>
                        <div class="form-group">
                            <label for="">Type</label>
                            <select name="mandatory" class="custom-select">
                                <option value=""
                                <?php if($subject['mandatory'] == ""): ?>
                                    selected
                                <?php endif; ?>
                                >
                                --subject type--
                                </option>
                                <option value="0"
                                <?php if($subject['mandatory'] == 0): ?>
                                    selected
                                <?php endif; ?>
                                >
                                Optional
                                </option>
                                <option value="1"
                                <?php if($subject['mandatory'] == 1): ?>
                                    selected
                                <?php endif; ?>
                                >
                                Mandatory
                                </option>
                            </select>
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" role="button" value="Update">
                    </form>
                </div>
            </div>
        </div>

<?php include '../includes/footer.php'; ?>