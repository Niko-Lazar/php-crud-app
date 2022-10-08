<?php include '../includes/header.php'; ?>
<?php require '../views/createUser.php' ?>

<div class="container">
    <div class="row justify-content-start">
        <div class="col-lg-6 cl-xs-12">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" name="addUserform">
                <legend class="mt-5 mb-5">New User</legend>
                <div class="form-group">
                    <label for="name">Name</label>
                    <?php if(!empty($nameErr)): ?>
                        <div class="text-danger">
                            <?php echo $nameErr; ?>
                        </div>
                    <?php endif; ?>
                    <input type="text" class="form-control" name="name"  required>
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <?php if(!empty($lastNameErr)): ?>
                        <div class="text-danger">
                            <?php echo $lastNameErr; ?>
                        </div>
                    <?php endif; ?>
                    <input type="text" class="form-control" name="lastName" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <?php if(!empty($emailErr)): ?>
                        <div class="text-danger">
                            <?php echo $emailErr; ?>
                        </div>
                    <?php endif; ?>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <?php if(!empty($roleErr)): ?>
                        <div class="text-danger">
                            <?php echo $roleErr; ?>
                        </div>
                    <?php endif; ?>
                    <select name="role" class="form-control">
                        <option selected disabled>-- Select role --</option>
                        <option value="administrator">Administrator</option>
                        <option value="profesor">Profesor</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <?php if(!empty($passwordErr)): ?>
                        <div class="text-danger">
                            <?php echo $passwordErr; ?>
                        </div>
                    <?php endif; ?>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <input type="submit" class="btn btn-primary" role="button" value="Add" name="submit">
            </form>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>