<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/stylep.css">
    <title>Edit Profile | DreamEd</title>
    <!--Tab Icon-->
    <link rel="shortcut icon" href="" type="image/svg+xml">
</head>

<body>

    <?php
        if(isset($_POST["save"])){
            $firstName = $_POST["$firstName"];
            $lastName = $_POST["$lastName"];
            require_once "assets/partials/database.php";
            
        }

    ?>

    <div class="container">
        <form action="profile.php" method="post">
            <h1>Edit Profile</h1>
            <input type="text" class="form-control" name="firstName" placeholder="First name">
            <input type="text" class="form-control" name="lastName" placeholder="Last name">
            <div class="buttons">
                <button type="submit" class = "btn btn-primary" name="save">Save</button>
                <!-- <a href="index.php"><a type="submit" class = "btn btn-primary" name="cancel">Cancel</a> -->
            </div>
        </form>
    </div>
    <!--Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>