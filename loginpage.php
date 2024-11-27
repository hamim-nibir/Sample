<?php 
    if(isset($_POST["submit"])){
        $userName = $_POST["username"];
        $Email = $_POST["email"];
        $Password = $_POST["password"];
        $Retype_password = $_POST["retype_password"];
        $passwordHash = password_hash($Password, PASSWORD_DEFAULT);

        require_once "partials/database.php";
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
        require_once "partials/database.php";
        $sql = "SELECT * FROM login_cred WHERE email = '$Email'";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if($user){
            if(password_verify($Password, $user["password"])){
                session_start();
                $_SESSION['user_id'] = $user["id"];
                $_SESSION['email'] = $user["email"];
                echo "<script>alert('Success!')</script>";
                header("Location:index.php");
                exit;
            }

        } else {
            echo "<script>alert('Login Failed')</script>";
        }
    }

?>