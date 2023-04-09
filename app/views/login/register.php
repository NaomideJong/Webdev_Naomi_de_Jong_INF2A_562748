<?php include __DIR__ . '/../header.php';
//if (isset($_SESSION['user'])) {
//    header('location: /home/account');
//}
?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card bg-dark text-white mt-5">
                    <div class="card-body">
                        <h2 class="card-title mb-4 text-center">Register</h2>
                        <form method="post">
                            <div class="form-group">
                                <label class="text-white">Username</label>
                                <input type="text" class="form-control border-white mb-2" name="username" placeholder="Enter username">
                            </div>
                            <div class="form-group">
                                <label class="text-white">Password</label>
                                <input type="password" class="form-control border-white mb-2" name="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label class="text-white">Confirm Password</label>
                                <input type="password" class="form-control border-white mb-2" name="password-confirm" placeholder="Confirm Password">
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">Register</button>
                            </div>
                        </form>
                        <p class="text-center mt-4 mb-0">Already have an account? <a href="/login" class="text-primary">Log in</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--<div class="register-box">-->
<!--    <h2>Register Here</h2>-->
<!--    <form method="post">-->
<!--        <div class="user-box">-->
<!--            <input type="text" name="username" required="">-->
<!--            <label>Username</label>-->
<!--        </div>-->
<!--        <div class="user-box">-->
<!--            <input type="password" name="password" required="">-->
<!--            <label>Password</label>-->
<!--        </div>-->
<!--        <div class="user-box">-->
<!--            <input type="password" name="password-confirm" required="">-->
<!--            <label>Confirm Password</label>-->
<!--        </div>-->
<!--        <input type="submit" name="submit" value="Register">-->
<!--    </form>-->
<!--    <p>Already have an account?</p>-->
<!--    <a href="/login">Login here</a>-->
<!--</div>-->


<?php include __DIR__ . '/../footer.php';
