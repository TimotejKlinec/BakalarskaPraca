<?php
session_start();
if(isset($_SESSION['verified_user_id']))
{
    $_SESSION['status'] = "You are already Logged in";
    header('Location: home.php');
    exit();
}
include('includes/header.php');
?>
<!-- <nav class="navbar navbar-dark bg-dark">
  <a class="navbar-brand mx-auto" href="login.php">Find Your Gear</a>
  <a class="navbar-brand" href="login.php">
    
  </a>
</nav> -->
<div class="py-5" id="login"  style="display: flex; justify-content: center;">
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-md-6">
                <?php
                if(isset($_SESSION['status']))
                {
                    echo "<h5 class='alert alert-success'>".$_SESSION['status']."</h5>";
                    unset($_SESSION['status']);
                }
                ?>
                <div class="text-center mb-5">
                    <h1 class="display-3">Find Your Gear</h1>
                    <img src="images/logo.png" alt="Logo" class="img-fluid" style="max-width: 250px; height: auto;">
                </div>
                <div class="card text-white bg-dark">
                    <div class="card-header">
                        <h4 class="card-title">Login</h4>
                    </div>
                    <div class="card-body">
                        <form action="logincode.php" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control bg-dark text-white" id="email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control bg-dark text-white" id="password">
                            </div>
                            <div class="text-center">
                                <button type="submit" name="login_btn" class="btn btn-primary">Login</button>
                            </div>
                            <div class="text-center mt-3">
                                <a href="register.php" class="text-white">Don't have an account?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include('includes/footer.php');
?>