<?php
    $showError = false;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include '_dbconnect.php';
        $email = $_POST["email"];
        $password = $_POST["password"];
        // $sql = "SELECT * from user where username = '$username' AND password = '$password'";
        $sql = "SELECT * from user where email = '$email'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if ($num == 1) {
            while($row = mysqli_fetch_assoc($result)){
                if (password_verify($password, $row['password'])) {
                    //session start hunxa aaba-->session is similar to cookies but it store in server site and it is more private than cookiees
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['SN'] = $row['SN'];
                    header("location: /FORUM/home.php?loginsucess=true"); //yesle chai login vaye paxi welcome page ma pathaedinxa
                }
                else{
                    $showError = true;
                }
            }
        }
        else{
            $showError = true;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loginin</title>
    <link rel="stylesheet" href="/FORUM/css/style_login.css">
    <script src="script.js"></script>
</head>

<body>
    <?php include '_header.php'; ?>
    <?php
    if ($showError) {
        echo '<script> alert("Invalid CREdentials") </script>';
    }
    ?>

    <div id="myform">
        <form class="form1" name="register" action="_login.php" onsubmit="return func1()" method='post'>
            <h1>LOG IN</h1>
            <div>
                <label for="email">Email:</label> <input type="email" name="email" id="email">
            </div>
            <br>
            <div>
                <label for="password">Password: </label> <input type="password" name="password" id="password">
            </div>
            <small class="san">Make sure you have type correct password</small>
            <div>
                <button class="buttom" type="submit">Login</button>
                <button class="buttom" type="reset">Reset</button>
            </div>

        </form>
    </div>


    <?php include '_footer.php'; ?>
</body>

</html>