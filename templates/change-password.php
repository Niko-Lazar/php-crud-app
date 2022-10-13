<?php include '../includes/header.php'; ?>
<?php require '../NOTviews/changePassword.php' ?>

<div class="container">
    <div class="row justify-content-center my-5">
        <img class="mt-5" src="../img/logo_vts.png" alt="">
    </div>
    <div class="row justify-content-center">
        
        <div class="mt-4 col-lg-6 cl-xs-12">
            <h5>Hello, <?php echo $_SESSION['loggedUser']['name']; ?></h5>
            <form class="mt-4" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                
                <div class="form-group">
                    <label for="password">Old password</label>

                    <?php if(!empty($oldPasswordErr)): ?>
                        <div class="text-danger">
                            <?php echo $oldPasswordErr; ?>
                        </div>
                    <?php endif; ?>
                    
                    <input type="password" name="oldPassword" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">New password</label>
                    
                    <?php if(!empty($newPasswordErr) && empty($oldPasswordErr)): ?>
                        <div class="text-danger">
                            <?php echo $newPasswordErr; ?>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($passwordMatchErr) && empty($oldPasswordErr)): ?>
                        <div class="text-danger">
                            <?php echo $passwordMatchErr; ?>
                        </div>
                    <?php endif; ?>

                    <input type="password" name="newPassword" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Repeat new password</label>
                    
                    <?php if(!empty($newPasswordRepeatErr) && empty($oldPasswordErr)): ?>
                        <div class="text-danger">
                            <?php echo $newPassword2Err; ?>
                        </div>
                    <?php endif; ?>

                    <input type="password" name="newPasswordRepeat" class="form-control" required>
                </div>
                <input type="submit" name="submit" class="btn btn-primary" role="button" value="Change password">
            </form>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>