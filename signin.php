<?php


$error = '';


session_start();

if(isset($_SESSION['auth_user'])){
    header("Location:index.php");
}

if(isset($_POST['submit'])){


    include 'includes/cleanInputs.php';
    include 'includes/database.php';


    $email = $_POST['email'];
    $password = $_POST['password'];

    $_SESSION['email']= $email;


    if($email == ''){
        $error = 'Email must not be empty';
    }
    elseif($password == ''){
        $error = 'Password must not be empty';
    }

    else{

        $cleanEmail = cleanUserInput($_POST['email']);
        $cleanPassword = sha1(cleanUserInput($_POST['password']));

        $sql = "select * from users where email='$cleanEmail' and password='$cleanPassword'";
        $dbc = mysqli_query($con,$sql);
        if($dbc){
            if($dbc->num_rows>0){
                unset($_SESSION['email']);
                while($row = mysqli_fetch_array($dbc)){
                    if(isset($_SESSION['auth_admin'])){
                        unset($_SESSION['auth_admin']);
                    }
                    $_SESSION['auth_user']=[
                        'firstname'=> (explode(' ',$row['full_name']))[0],
                        'id'=>$row['id'],
                        'email'=> $row['email'],
                    ];
                }
                if(isset($_SESSION['booking']) && $_SESSION['booking'] ==1){
                    unset($_SESSION['booking']);
                    echo "
                      <script type=\"text/javascript\">
                        alert('You are logged in');
                        window.location='bookpackage.php'
                      </script>";
                }
                else{
                    echo "
                      <script type=\"text/javascript\">
                        alert('You are logged in');
                        window.location='../../index.php'
                      </script>";
                }

            }
            else{
                $error = 'Incorrect email or password';
            }

        }
        else{
            $error = mysqli_error($con);
        }

    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Expert-Events</title>
    <link rel="stylesheet" href="style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="login">
<form class="signin-form" action="" method="post">
    <?php
    if($error!=''){
        ?>
        <div class="alert alert-danger  fade show" role="alert">
            <div id="error"><?=$error?></div>
        </div>
    <?php }?>
    <div>
        <label for="email">Email address</label>
        <input
                name="email"
                required
                id="email"
                type="email"
                placeholder="me@example.com"
                value="<?=$_SESSION['email'] ?? '' ?>"
        />
    </div>

    <div>
        <label for="password">Input password</label>
        <input
                name="password"
                required
                id="password"
                type="password"
                placeholder="Input password"
        />
    </div>
    <div class="btn-form">
        <button type="submit" name="submit" class="form-btn">Sign in</button>
    </div>
</form>
</body>
</html>
