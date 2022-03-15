<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Threads List</title>
</head>
<link rel="stylesheet" href="css/style_threadslist.css">
<script src="partials/script.js"></script>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>
    <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `threads` WHERE threads_id='$id'";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            // $cat_id =  $row['threads_id'];
            $title =  $row['threads_title'];
            $desc =  $row['threads_desc'];
            $time =  $row['timestamp'];
            $user_id = $row['threads_user_id'];
            $sql2 = "SELECT email FROM `user` WHERE SN='$user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $username = $row2['email'];
        }
    ?>
    <?php
        $show = false;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include "partials/_dbconnect.php";
            // $th_title = $_POST["title"];
            $the_desc = $_POST["comment"];
            // to replace charaters which stop user to run script in comment 
            $the_desc = str_replace("<", "&lt;", $the_desc);
            $the_desc = str_replace(">", "&gt;", $the_desc);
            $SN = $_POST['SN'];
            $sql = "INSERT INTO `comments` (`comment_id`, `comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES (NULL, '$the_desc' , '$id', '$SN' ,current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $show = true;
            }

        }
    ?>

    <?php
    if ($show) {
        echo '
        <script> alert("Your comment has been added"); </script>
        ';
    }

    ?>
    <div class="height">
        <div class="container">
            <div class="jumr">
                <h1> <?php echo $title?></h1>
                <p><?php echo $desc?> </p>
                <hr style="margin: 10px 0px;">
                <p>This is the peer to peer forum. No Spam / Advertising / Self-promote in the forums. Do not post
                    copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post
                    questions. Do not PM users asking for help</p>
                <p><b>-posted by <?php echo $username?> at <?php echo $time?></b></p>
            </div>
        </div>

        <div class="container">
            <h2>Post Your Comments</h2>
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo '
            <div id="myform">
            <form name="register" action="'. $_SERVER['REQUEST_URI'] . '" method="post" onsubmit="return func4()">
            <label for="comment">Type Your Comment: </label>
            <div>
            <textarea name="comment" id="comment" cols="110" rows="5"></textarea>
            <input type="hidden" name="SN" value = "'.$_SESSION["SN"].'">
            </div>
            <div>
            <button class="buttom" id = "mybutton" type= "submit">Post Comment</button>
            </div>
            
            </form>
            </div>
            ';
        }
        else {
            echo'
            <h3>You are not login. Please login to Comment!</h3>';
        }
            ?>
        <h2 style = "margin-top: 20px;">Disscusion</h2>
        <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
        $result = mysqli_query($conn, $sql);
        $noResult= true;
        while($row = mysqli_fetch_assoc($result)){
            $noResult = false;
            $id =  $row['comment_id'];
            $dt =  $row['comment_time'];
            $comment_desc =  $row['comment_content'];
            $user_id = $row['comment_by'];
            $sql2 =  "SELECT email FROM `user` WHERE SN='$user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);

            echo'
            <div class="media">
            <img src="image/userdefault.png" width="30px" alt="....">
            <div class="media-body">
            <h3>  '. $row2['email'] .' at '.$dt.' </h3>
            <p> -'.$comment_desc.'</p>
            </div>
            </div>
            <hr>
            ';
        }
        if ($noResult) {
            echo '
            <div class="result">
            <p> No comments found! </p>
            <p1>Be the first one to reply.</p1>
            </div>
            ';
        }

        ?>
    </div>
    </div>
    <?php include 'partials/_footer.php'; ?>
</body>

</html>