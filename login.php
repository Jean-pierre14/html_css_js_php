<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog</title>
    <link rel="stylesheet" href="./css/semantic/semantic.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>
<body>
    <div class="ui container inverted center">
        <div class="row">
            <div class="col-md-6 col-sm-12 segment m-md-3 ui dividing">

                <?php require_once "server.php";
                    include("./error.php");
                ?>
                <form action="" method="post" class="ui form">
                    <div class="field">
                        <label for="username">Username</label>
                        <div class="ui left icon input">
                            <i class="icon user red"></i>
                            <input type="text" value="<?php print $username;?>" name="username" id="username" placeholder="Username">
                        </div>
                    </div>

                    <div class="field">
                        <label for="pasword">Password</label>
                        <div class="ui left icon input">
                            <i class="icon lock red"></i>
                            <input type="password" value="<?php print $password;?>" name="password" id="password" placeholder="Password">
                        </div>
                    </div>
                    <button type="submit" name="login" class="icon ui labeled button submit"><i class="icon sign-in"></i>Log In</button>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>