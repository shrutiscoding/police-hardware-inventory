<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('home.php', false);}
?>
<?php include_once('layouts/header.php'); ?>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="libs/css/style.css">
<style>
     body {
        background: url('libs/images/banner.jpg') no-repeat center center fixed;
        background-size: cover;            
        height: 100vh;             
        }
        body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(41, 41, 41, 0.6), rgba(39, 38, 38, 0.9));
        z-index: 0;
    }
</style>
<div class="login-page">
    <div class="text-center">
       <h1>Login</h1>
       
    </div>
    <?php echo display_msg($msg); ?>
    
    
    <form id="loginForm" method="post" action="auth.php" class="clearfix">
    <div class="form-group">
        <label for="username" class="control-label">Username</label>
        <div class="input-group">
            <i class="fa-solid fa-user"></i>
            <input type="text" class="form-control" name="username" placeholder="Username" required>
        </div>
    </div>

    <div class="form-group">
        <label for="password" class="control-label">Password</label>
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-danger">Login</button>
    </div>
</form>
   
    <div class="social-login">
        <a href="#"><i class="fab fa-google"></i></a>
        <a href="#"><i class="fab fa-facebook-f"></i></a>
    </div>

 
    <div class="forgot-password">
        <a href="forgot_password.php">Forgot Password?</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");

    loginForm.addEventListener("submit", async function (event) {
        event.preventDefault();

        let username = document.querySelector('input[name="username"]').value.trim();
        let password = document.querySelector('input[name="password"]').value.trim();

        if (username === "" || password === "") {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Please enter both username and password!",
            });
            return;
        }

        let userType = await validateCredentials(username, password);

        if (userType) {
            let title = "";
            let text = "";

            if (userType === "admin") {
                title = "Admin Login Successful!";
                text = "Welcome, Admin! Redirecting to the admin panel...";
                
                // Trigger expiry check after login
                

            } else if (userType === "special") {
                title = "Special User Login Successful!";
                text = "Welcome, Special User! Redirecting to your dashboard...";
                
            } else {
                title = "User Login Successful!";
                text = "Welcome! Redirecting to your dashboard...";
            }

            Swal.fire({
                icon: "success",
                title: "Logging in...",
                text: "Please wait while we authenticate your credentials.",
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                Swal.fire({
                    icon: "success",
                    title: title,
                    text: text,
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    loginForm.submit(); 
                });
            });
        } else {
            Swal.fire({
                icon: "error",
                title: "Login Failed",
                text: "Incorrect username or password. Please try again.",
            });
        }
    });

    async function validateCredentials(username, password) {
        return new Promise((resolve) => {
            setTimeout(() => {
                if (username === "admin" && password === "admin") {
                    resolve("admin");
                } else if (username === "special" && password === "special") {
                    resolve("special");
                } else if (username === "user" && password === "user") {
                    resolve("user");
                } else {
                    resolve(false);
                }
            }, 1000);
        });
    }
});
</script>

<?php include_once('layouts/footer.php'); ?>