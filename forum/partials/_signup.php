<?php
$showAlert = false;
$showError = false;
$showError2 = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '_dbconnect.php';
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    // Check whether this username exists
    $existSql = "SELECT * FROM `user` WHERE email = '$email'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        // $exists = true;
        $showError2 = true;
    }
    else{
         // $exists = false; 
        if(($password == $cpassword)){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `user` ( `email`, `password`, `dt`) VALUES ('$email', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result){
                $showAlert = true;
            }
        }
        else{
            $showError = true;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="/FORUM/css/style_login.css">
    <script src="/FORUM/partials/script.js"></script>
</head>

<body>
    <?php include '_header.php'; ?>

    <div id="myform">
        <form class="form1" name="register" action="_signup.php" onsubmit="return func()" method="post">
            <h1>SIGN UP</h1>
            <div>
                <label for="email">Email:</label> <input type="email" name="email" id="email">
            </div>
            <br>
            <div>
                <label for="password">Password: </label> <input type="password" name="password" id="password">
            </div>
            <br>
            <div>
                <label for="cpassword">Confirm Password: </label> <input type="password" name="cpassword" id="cpassword">
            </div>
            <small>Make sure you have type same password</small>
            <div>
                <button class="buttom" type="submit">SignUp</button>
                <button class=" buttom" type="reset">Reset</button>
            </div>

        </form>
    </div>
    <?php
    if ($showAlert) {
        echo '<script> alert("Form have submitted succesfully so go to the login page for login"); </script';
    }
    if ($showError) {
        echo '<script> alert("password donot match"); </script';
    }
    if ($showError2) {
        echo '<script> alert("username is already taken"); </script';
    }
    ?>
    <?php include "_footer.php"; ?>
</body>

</html>