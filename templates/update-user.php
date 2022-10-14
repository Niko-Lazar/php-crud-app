<?php include '../includes/header.php'; ?>
<?php require '../NOTviews/updateUser.php' ?>

<div class="container">
    <div class="row justify-content-start">
        <div class="col-lg-6 cl-xs-12">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=$userID"; ?>" method="POST">
                <legend class="mt-5 mb-5">Update user</legend>
                <div class="form-group">
                    <label for="name">Name</label>

                    <?php if(!empty($userErrorFields['name'])): ?>
                        <div class="text-danger">
                            <?php echo $userErrorFields['name']; ?>
                        </div>
                    <?php endif; ?>

                    <input type="text" class="form-control" name="name" 
                    value="<?php echo $user['name']; ?>"
                    required>
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name</label>

                    <?php if(!empty($userErrorFields['lastName'])): ?>
                        <div class="text-danger">
                            <?php echo $userErrorFields['lastName']; ?>
                        </div>
                    <?php endif; ?>

                    <input type="text" class="form-control" name="lastName"
                    value="<?php echo $user['lastName']; ?>"
                    required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>

                    <?php if(!empty($userErrorFields['email'])): ?>
                        <div class="text-danger">
                            <?php echo $userErrorFields['email'] ?>
                        </div>
                    <?php endif; ?>

                    <input type="email" class="form-control" name="email"
                    value="<?php echo $user['email']; ?>"
                    required>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>

                    <?php if(!empty($userErrorFields['role'])): ?>
                        <div class="text-danger">
                            <?php echo $userErrorFields['role']; ?>
                        </div>
                    <?php endif; ?>
                    <?php if($user['role'] == 'student'): ?>
                        <select name="role" class="form-control">
                            <option value="student" selected>Student</option>
                        </select>
                    <?php else: ?>
                        <select name="role" class="form-control">
                            <option value=""
                                <?php if($user['role'] == ""): ?>
                                    selected
                                <?php endif; ?>
                                >
                                --Select role--
                            </option>
                            <?php foreach(['administrator', 'profesor'] as $role): ?>
                                <option value=<?php echo $role ?>
                                    <?php echo $user['role'] === $role ? 'selected' : ''; ?>
                                    >
                                    <?php echo ucfirst($role); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>

                    <?php if(!empty($userErrorFields['password'])): ?>
                        <div class="text-danger">
                            <?php echo $userErrorFields['password']; ?>
                        </div>
                    <?php endif; ?>

                    <input type="password" class="form-control"
                        value="<?php echo $user['password']; ?>"
                        name="password"
                        required>
                </div>
                <input type="submit" class="btn btn-primary" role="button" value="Save" name="submit">
            </form>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>