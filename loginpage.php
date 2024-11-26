<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Login/Register | DBMS</title>
    <!--Tab Icon-->
    <link rel="shortcut icon" href="" type="image/svg+xml">
</head>

<body>
<?php 
    if(isset($_POST["submit"])){
        $userName = $_POST["username"];
        $Email = $_POST["email"];
        $Password = $_POST["password"];
        $Retype_password = $_POST["retype_password"];
        $passwordHash = password_hash($Password, PASSWORD_DEFAULT);

        require_once "assets/partials/database.php";
        $sql = "SELECT * FROM login_cred WHERE email = '$Email'";
        $result = mysqli_query($conn, $sql);
        $rowCount = mysqli_num_rows($result);
        if($rowCount>0){
            echo "<script>alert('Email already exists')</script>";
        }
        else if(strlen($Password) < 8){
            echo "<script>alert('Password must be at least 8 characters')</script>";
        }
        else if($Password != $Retype_password){
            echo "<script>alert('Password and Retype password must be the same')</script>";
        }
        else{
            $sql = "INSERT INTO login_cred(username, email, password) VALUES (?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt= mysqli_stmt_prepare($stmt, $sql);
            if($prepareStmt){
                mysqli_stmt_bind_param($stmt, "sss", $userName, $Email, $passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<script>alert('Success!')</script>";
            }
            else{
                die("Something went wrong");
            }
        }
    }

    if(isset($_POST["btn_login"])){
        $Email = $_POST["email"];
        $Password = $_POST["password"];
        require_once "assets/partials/database.php";
        $sql = "SELECT * FROM login_cred WHERE email = '$Email'";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if($user){
            if(password_verify($Password, $user["password"])){
                echo "<script>alert('Success!')</script>";
                header("Location:index.php");
            }

        } else {
            echo "<script>alert('Login Failed')</script>";
        }
    }

?>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="loginpage.php" method="post">
                <h1>Create Account</h1>
                <input type="text" class="form-control" name="username" placeholder="Username" required>
                <input type="email" class="form-control" name="email" placeholder="Email" required>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <input type="password" class="form-control" name="retype_password" placeholder="Retype Password" required>
                <button type="submit" name="submit">Register</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="loginpage.php" method="post">
                <h1>Login</h1>
                <input type="email" class="form-control" name="email" placeholder="Email" required>
                <input type="password"  class="form-control" name="password" placeholder="Password" required>
                <!-- <a href="/reset_password.php">Forgot Password?</a> -->
                <button type="submit" name="btn_login">Login</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome!</h1>
                    <p>Already have an account? Sign in.</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Welcome!</h1>
                    <p>Don't have an account? Sign up with your personal details to get all the services.</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    
    <!--custom JS-->
    <script src="assets/js/login.js"></script>

    <!--Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>