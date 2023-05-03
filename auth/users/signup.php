<?php


$error = '';


session_start();

if(isset($_SESSION['auth_user'])){
    header("Location:../../users/users-dashboard.php");
}

if(isset($_POST['submit'])){


    include '../../includes/cleanInputs.php';
    include '../../includes/database.php';


    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $_SESSION['full_name'] = $full_name;
    $_SESSION['email']= $email;


    if($full_name == ''){
        $error = 'Full name must not be empty';
    }
    elseif($email == ''){
        $error = 'Email must not be empty';
    }
    elseif($password == ''){
        $error = 'Password must not be empty';
    }
    elseif($cpassword == ''){
        $error = 'Confirm Password ';
    }
    elseif($password!=$cpassword){
        $error = 'Passwords do not match';
    }
    else{
        $cleanFullname = cleanUserInput($_POST['full_name']);
        $cleanEmail = cleanUserInput($_POST['email']);
        $cleanPassword = sha1(cleanUserInput($_POST['password']));


        try {
            $sql = "insert into users (full_name,email,password) values('$cleanFullname','$cleanEmail','$cleanPassword')";
            $dbc = mysqli_query($con,$sql);
            if($dbc){
                unset($_SESSION['full_name']);
                unset($_SESSION['lastname']);
                unset($_SESSION['email']);

                echo "
                    <script type=\"text/javascript\">
                      alert('Registration success, You are being redirected to Login');
                      window.location='signin.php'
                    </script>";
            }

        } catch (mysqli_sql_exception $ex) {
            $error = 'Error encountered, try again later';

            if ($ex->getCode() == 1062) {

                $error = 'Email is already registered';
            }
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
    <link rel="stylesheet" href="../../style.css" />
  </head>
  <body class="login">
    <form class="signin-form" action="" method="post">
        <?php
        if($error!=''){
            ?>
            <div class="alert" >
                <div id="error"><?=$error?></div>
            </div>
        <?php }?>
      <div>
        <label for="full-name">Full Name</label>
        <input
          name="full_name"
          required
          id="full-name"
          type="text"
          placeholder="John Doe"
          value="<?=$_SESSION['full_name'] ?? '' ?>"
        />
      </div>
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
      <div>
        <label for="password">Confirm password</label>
        <input
          name="cpassword"
          required
          id="password"
          type="password"
          placeholder="Confirm password"
        />
      </div>
      <div class="btn-form">
        <button type="submit" name="submit" class="form-btn">Sign up now</button>
      </div>
    </form>
  </body>
</html>
