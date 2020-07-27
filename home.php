<?php
session_start();
include("db.php");
$username = $_SESSION['username'];

if(!isset($username)){
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog post <?php print $_SESSION['username'];?></title>
    <link rel="stylesheet" href="./css/semantic/semantic.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/lightbox.min.css">
</head>
<body>
    <div class="container ui">
        <div class="ui menu">
            <a href="#" class="item"><?php print $_SESSION['username'];?></a>
            <a href="#" class="item">Dashboard</a>
            <a href="#" class="item">Messages</a>
            <a href="#" class="item">Help</a>
            <a href="loggout.php" class="item">Sign out</a>
        </div>
    </div>

    <div class="container ui m-0">
        <div class="row">
        <?php
                        $sql = "SELECT * FROM files_tb";
                        $result = mysqli_query($con, $sql);
                        while($row = mysqli_fetch_assoc($result)){
                            $numberImage = count($row);
                            if($numberImage < 0){
                                ?>
                                <div class="col-md-12 bg-dark white text-center">
                                    <h3>The is not data in your DB</h3>
                                </div>
                                <?php
                            }else{
                                ?>
                                <?php
                                    $likeSql = "SELECT * FROM like_post WHERE post_like = '".$row['id']."'";
                                    $runlike = mysqli_query($con , $likeSql);
                                    $count = mysqli_fetch_row($runlike);
                                ?>
                                <div class="col-md-6 col-xl-4 bg-light p-1 m-1 card">
                                    <a href="upload/<?php echo $row['name_file'];?>" data-lightbox="mygallery"><img src="upload/<?php echo $row['name_file'];?>" alt="" class="img-fluid ui image center"></a>
                                    <div class="ui menu mobile computer">
                                        <a href="home.php?like=<?php print $row['id']?>" title="Do you want to like this photo of <?php echo $row['name_file']?>" class="item"><?php if($count){print "<i class='icon red like'></i>";}else{print "<i class='icon like'></i>";} ?><span class="badge">23</span></a>
                                        <a href="" class="item"><i class="icon chat"></i><span class="badge">23</span></a>
                                        <a href="" class="item"><i class="icon share"></i><span class="badge">23</span></a>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        if(isset($_GET['like'])){
                            $id = $_GET['like'];
                            $sql = "INSERT INTO like_post(post_like, create_at, username _like) VALUES('$id', now(), '".$_SESSION['username']."')";
                            $run = mysqli_query($con, $sql);
                            ?>
                            <script>window.open('home.php?like_image', '_self');</script>
                            <?php
                        }
                    ?>
        </div>
    </div>
    <script src="./js/lightbox-plus-jquery.min.js"></script>
</body>
</html>