<?php include '../includes/header.php'; ?>
<?php require '../NOTviews/login.php'; ?>

<div class="container">
    <div class="row justify-content-center my-5">
        <img class="mt-5" src="../img/logo_vts.png" alt="">
    </div>
    <div class="row justify-content-center">
        <div class="mt-4 col-lg-6 cl-xs-12">
            <h5 class="text-success">
                <?php if($passwordIsReset): ?>
                    Password changed successfuly, please login again
                <?php endif; ?>
            </h5>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                
                <?php if($_SERVER["REQUEST_METHOD"] != "GET" && !isset($user)): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>No user found</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="email">Email adress</label>

                    <?php if(!empty($emailErr)): ?>
                        <div class="text-danger">
                            <?php echo $emailErr; ?>
                        </div>
                    <?php endif; ?>

                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>

                    <?php if(isset($passwordMatches) && !$passwordMatches): ?>
                        <div class="text-danger">
                            Password does not match
                        </div>
                    <?php endif; ?>
                    
                    <input type="password" name="password" class="form-control" required>
                </div>
                <input type="submit" name="submit" class="btn btn-primary" role="button" value="Login">
            </form>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>