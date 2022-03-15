<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Forum</title>
</head>
<link rel="stylesheet" href="css/homestyle.css">

<body>
    <?php include 'partials/_header.php'; ?>
    <?php include 'partials/_dbconnect.php'; ?>
    <div id="container">
        <div class="s_description" >
            <h1 >
                <div> <span>L</span><span>e</span><span>t</span><span>'</span><span>s</span>
                    <span>D</span><span>i</span><span>s</span><span>c</span><span>u</span><span>s</span><span>s</span>
                    <span>O</span><span>u</span><span>r</span><span>s</span>
                    <span>P</span><span>r</span><span>o</span><span>b</span><span>l</span><span>e</span><span>m</span><span>s</span><span>.</span>
                </div>
            </h1>
        </div>
        <!-- <img id="codeimg" src="image/coding1.jpg" alt="#"> -->
    </div>
    <h2 class="heading">𝕮-omucat>Browse Catagories</h2>

    <div id="row">
        <!-- Fetch all the catagories -->
        <?php $sql = "SELECT * FROM `catagories`";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $id =  $row['catagories_id'];
            $cat =  $row['catagories_name'];
            $dog =  $row['catagories_desc'];
            echo '
            <div class="card">
            <img id = "cardimg" src="image/' . $cat . '.png" alt="loading....">
            <div class="card-body">
            <h2> <a  style="border: none;" href = "threadlist.php?catid=' . $id . '">' . $cat . ' </a> </h2>
            <p>' . substr($dog, 0, 90) . '.....</p>
            <a class = "bootn" href="threadlist.php?catid=' . $id . '">View Threads</a>
            </div>
            </div>';
        }

        ?>
    </div>
    <?php
    if (isset($_GET['loginsucess']) && $_GET['loginsucess'] == "true") {
        echo '<script> alert("SUCESS! login sucessfuly") </script>';
    }
    ?>
    <div id = "f_contion">
        <div id="f_contion3">
            
        <div id="f_contion2">
        </div>
                hjgfkfjh
            </div>
    </div>
    
    </div>
    <?php include 'partials/_footer.php'; ?>
</body>

</html>