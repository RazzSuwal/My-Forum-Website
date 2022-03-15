<?php
session_start();
include '_dbconnect.php';
echo'
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Document</title>
<script src="partials/script.js"></script>
<link rel="stylesheet" href="/FORUM/css/style_header.css">
</head>

<body>
<nav>
<div id="navbar">
<a style="background-color: purple;" href="/FORUM/home.php">𝕮-omucate</a>
<a href="/FORUM/home.php">Home</a>
<a href="/FORUM/about.php">About</a>
<div class="dropdown">
<button onclick= "myFunction()" class="dropbtn">Catagories▼
</button>
<div id="myDropdown" class="dropdown-content">';

$sql = "SELECT catagories_name, catagories_id FROM `catagories`";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo'
    <a href="/FORUM/threadlist.php?catid='.$row['catagories_id'].'">'.$row['catagories_name'].'</a>
    ';
}


echo'
</div>
</div>
<a href="/FORUM/contact.php">Contact</a>
</div>
<div id="left">

<form action="search.php" method = "get">
<input id= "searchform" class="yu" name="search" type="text" placeholder="Search.......">
<button class="yu" type="submit">Search</button>
</form>
';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo'
    <h4 class = "h4">Welcome to 𝕮-omucate </h4>
    <a class="myclass" href="partials/_logout.php">Logout</a>
    ';
}

else {
    echo'
    <a class = "myclass" href="/FORUM/partials/_login.php">Login</a>
    <a class = "myclass" href="/FORUM/partials/_signup.php">Signup</a>';
}
echo'
</div>
</nav>
</body>
</html>
';
?>