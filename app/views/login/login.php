<?php include __DIR__ . '/../header.php';
if (isset($_SESSION['user'])) {
    header('location: /home/account');
}
?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 mt-4">
                <form method="post" class="form-signin bg-dark p-4">
                    <h2 class="card-title mb-4 text-center">Login</h2>
                    <div class="form-label-group">
                        <label class="text-white">Username</label>
                        <input type="text" id="inputUsername" name="username" class="form-control mb-2" placeholder="Username" required autofocus>
                    </div>
                    <div class="form-label-group">
                        <label class="text-white">Password</label>
                        <input type="password" id="inputPassword" name="password" class="form-control mb-2" placeholder="Password" required>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-lg btn-primary btn-block mt-4" type="submit" name="submit">Log in</button>
                    </div>
                    <p class="mt-3 mb-0 text-white">Don't have an account? <a href="/register" class="text-primary">Register</a></p>
                </form>
            </div>
        </div>
    </div>

<!--<link rel="stylesheet" href="/css/login.css">-->
<!--    <div class="login-box">-->
<!--        <h2>Login Here</h2>-->
<!--        <form method="post">-->
<!--            <div class="user-box">-->
<!--                <input type="text" name="username" required="">-->
<!--                <label class="text-white">Username</label>-->
<!--            </div>-->
<!--            <div class="user-box">-->
<!--                <input type="password" name="password" required="">-->
<!--                <label class="text-white">Password</label>-->
<!--            </div>-->
<!--            <input type="submit" name="submit" value="Login">-->
<!--        </form>-->
<!--        <p>Don't have an account?</p>-->
<!--        <a href="/register">Register here</a>-->
<!--    </div>-->
<?php include __DIR__ . '/../footer.php';
