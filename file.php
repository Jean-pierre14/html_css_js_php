<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Try file</title>
    <link rel="stylesheet" href="./css/semantic/semantic.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/lightbox.min.css">
</head>
<body>
    <div class="container p-2">
        <div class="jumbotron">
            <h3 class="text-center">Upload file using php</h3>
            <p class="text-center"><i class="icon blue php"></i> Php is the easy languge in the world</p>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 bg-dark p-2 white">

                <?php
                    $con = new mysqli("localhost", "root", "", "web") or die("Could not connecte to that db or create it in your system");
                    // if($con){echo "connected";}else{echo "Not connected";}
                    if(isset($_POST['submit'])){

                        $target_dir = 'upload/';
                        $target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                        $uploadOk = 1;

                        $image = mysqli_real_escape_string($con, $_FILES['fileToUpload']['name']);

                        // check if the file is an image or not
                        $check = getimagesize($_FILES['fileToUpload']['tmp_name']);

                        if($check !== false){
                            echo "File is an image - ". $check['mime'] . ".<br>";
                        }else{
                            echo "File is not an image <br>";
                            $uploadOk = 0;
                        }

                        // to check if the is exist or used
                        if(file_exists($target_file)){
                            echo "the file is already exist <br>";
                            $uploadOk = 0;
                        }

                        // check the size
                        if($_FILES['fileToUpload']['size'] > 300000){
                            echo "the size is to large";
                            $uploadOk = 0;
                        }

                        // to allow type of files to upload

                        if($imageFileType !== "jpg" && $imageFileType !== "png" && $imageFileType !== "jpeg" && $imageFileType !== "gif"){
                            echo "Files allow are jpg, png, jpeg, gif not " .$check['mime'].".";
                            $uploadOk = 0;
                        }

                        // the upload error now
                        if($uploadOk == 0){
                            echo "Your file is not uploaded";
                        }else{
                            if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)){
                                $sql = "INSERT INTO files_tb(name_file, create_at) VALUES('$image',NOW())";
                                $result = mysqli_query($con, $sql);
                                echo "the file ". basename($_FILES['fileToUpload']['name']) . " has been uploaded"; 
                            }else{
                                echo "the was an error while your upload your file";
                            }
                        }
                    }
                ?>

                <form action="file.php" method="post" enctype="multipart/form-data">
                    <div class="form-group ui field">
                        <label for="fileToUpload">Select image to upload:</label>
                        <input type="file" name="fileToUpload" id="fileToUpload" class="form-control-file">
                    </div>

                    <button type="submit" name="submit" class="icon labeled button submit ui"><i class="icon file"></i>Upload</button>
                </form>
            </div>

            <div class="col-lg-8">
                <h3>File list</h3>
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
                                        <a href="file.php?like=<?php print $row['id']?>" title="Do you want to like this photo of <?php echo $row['name_file']?>" class="item"><?php if($count){print "<i class='icon red like'></i>";}else{print "<i class='icon like'></i>";} ?><span class="badge">23</span></a>
                                        <a href="" class="item"><i class="icon chat"></i><span class="badge">23</span></a>
                                        <a href="" class="item"><i class="icon share"></i><span class="badge">23</span></a>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        if(isset($_GET['like'])){
                            $id = $_GET['like'];
                            $sql = "INSERT INTO like_post(post_like, create_at) VALUES('$id', now())";
                            $run = mysqli_query($con, $sql);
                            ?>
                            <script>window.open('file.php?like_image', '_self');</script>
                            <?php
                        }
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
    <script src="./js/lightbox-plus-jquery.min.js"></script>
</body>
</html>