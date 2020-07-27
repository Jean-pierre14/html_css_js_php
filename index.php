<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DB first</title>
    <link rel="stylesheet" href="./css/semantic/semantic.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>
<body>
    <fieldset style="border: 3px solid #666">
        <?php
            session_start();
            $con = mysqli_connect("localhost", "root", "", "web") or die("could not be connect chiruza");
            // if($con){print "Connection success";}
            // else{print "Connectiuon fail";}
            $error = array();

            if(isset($_POST['submit'])){
                $tableName = $_POST['username'];

                if(empty($tableName)){array_push($error, "the username is empty");}
                
                if(count($error) == 0){
                    if(!empty($tableName)){array_push($error, "success");}
                    $createTable = "use web;CREATE TABLE '$tableName'(
                        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                        mount_pay VARCHAR(50) NOT NULL,
                        pay_at DATETIME CURRENT_TIMESTAMP,
                        bank_at VARCHAR(50) NOT NULL)";
                    $runTable = mysqli_query($con, $createTable);
                }
            }
        ?>
        <legend>Insert into and create table</legend>
        
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-xl-3 p-2"><?php if(isset($error)):?>
                    <?php foreach($error as $errors):?>
                        <div class="alert alert-danger">
                            <?php echo $errors;?>
                        </div>
                    <?php endforeach;?>
                    <?php endif;?>
                    <form action="" method="post" class="ui field">
                        <label for="user">username</label>
                        <input type="text" name="username" id="user" class="form-control" placeholder="Username"><br><br>
                        <label for="class">Class</label>
                        <input type="text" name="class" id="class" class="form-control" placeholder="class"><br><br>
                        <label for="country">Country</label>
                        <input type="text" name="country" id="country" placeholder="country" class="form-control"><br><br>
                        <label for="school">school</label>
                        <input type="text" name="school" id="school" placeholder="school" class="form-control"><br><br>
                        <button type="submit" class="ui icon labeled button" name="submit"><i class="icon save"></i>Send</button>
                    </form>
                </div>
            </div>
        </div>
    </fieldset>
    
</body>
</html>