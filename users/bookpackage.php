<?php

session_start();

if(!isset($_SESSION['auth_user'])){
    $_SESSION['booking'] = 1;
    header("Location:../auth/users/signin.php");
}


$auth_user_id = $_SESSION['auth_user']['id'];
$error = '';
$success_msg = '';

if(isset($_POST['submit'])){


    include '../includes/cleanInputs.php';
    include '../includes/database.php';


    $package = $_POST['package'];
    $type = $_POST['type'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $guests = $_POST['guests'];
    $additional_info = $_POST['add-info'];


    $_SESSION['selected_package'] =  $_POST['package'];
    $_SESSION['selected_event_type'] =  $_POST['type'];
    $_SESSION['guests'] =  $_POST['guests'];
    $_SESSION['date'] =  $_POST['date'];
    $_SESSION['time'] =  $_POST['time'];
    $_SESSION['add-info'] =  $_POST['add-info'];



    if($package == ''){
        $error = 'Please select a package';
    }
    elseif($type == ''){
        $error = 'Please select event type';
    }
    elseif($date == ''){
        $error = 'Please select date';
    }
    elseif($time == ''){
        $error = 'Please select time';
    }
    elseif($guests == ''){
        $error = 'Please select number of guests';
    }
    elseif(!is_numeric($guests)){
        $error = 'Number of guests must be a number';
    }
    else{

        $cleanPackage = cleanUserInput($_POST['package']);
        $cleanType = cleanUserInput($_POST['type']);
        $cleanDate = cleanUserInput($_POST['date']);
        $cleanTime = cleanUserInput($_POST['time']);
        $cleanGuests = cleanUserInput($_POST['guests']);
        $cleanAddinfo = cleanUserInput($_POST['add-info']);

        // Check for date and time availability
        try {
            $dateAvailabiltySql = "select * from events where date = '$cleanDate' and time = '$cleanTime' ";
            $check = mysqli_query($con,$dateAvailabiltySql);

            if($check){
                if ($check->num_rows > 0){
                    $error = 'Oops, An event had already been booked for the date and time selected';
                }
                else{
                    // Proceed to book event
                    try {
                        $sql = "insert into events (package,type,date,time,no_of_guests,additional_info,user_id) values(
                               '$cleanPackage','$cleanType','$cleanDate','$cleanTime','$cleanGuests','$cleanAddinfo','$auth_user_id')";
                        $dbc = mysqli_query($con,$sql);
                        if($dbc){

                            unset($_SESSION['selected_package']);
                            unset($_SESSION['selected_event_type']);
                            unset($_SESSION['guests']);
                            unset($_SESSION['date']);
                            unset($_SESSION['time']);
                            unset($_SESSION['add-info']);

                            echo "
                                <script type=\"text/javascript\">
                                  alert('Hurray!, Your event has been booked successfully');
                                  window.location='bookpackage.php'
                                </script>";
                        }

                    } catch (mysqli_sql_exception $ex) {
                        $error = 'Error encountered, try again later';
                    }
                }
            }

        } catch (mysqli_sql_exception $ex) {
            $error = 'Error encountered, try again later';

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
    <link rel="stylesheet" href="../style.css" />

  </head>
  <?php include_once '../includes/navbar.php' ?>
  <body class="bookpackage">
    <form class="signin-form book-form" method="post" action="">
        <?php
        if($error!=''){
            ?>
             <div class="alert">
                <div id="error"><?=$error?></div>
             </div>
        <?php }?>
      <div>
          <label for="package">Choose Package *</span></label>
        <select
          name="package"

          id="select-package"
          placeholder="select package"
        >
                <option value="">select</option>
                <option value="Bronze"<?php if (isset($_SESSION['selected_package']) && $_SESSION['selected_package'] == 'Bronze') { echo ' selected'; } ?>>Bronze</option>
                <option value="Silver"<?php if (isset($_SESSION['selected_package']) && $_SESSION['selected_package'] == 'Silver') { echo ' selected'; } ?>>Silver</option>
                <option value="Gold"<?php if (isset($_SESSION['selected_package']) && $_SESSION['selected_package'] == 'Gold') { echo ' selected'; } ?>>Gold</option>
                <option value="Platinum"<?php if (isset($_SESSION['selected_package']) && $_SESSION['selected_package'] == 'Platinum') { echo ' selected'; } ?>>Platinum</option>
            </select>

      </div>
      <div>
        <label for="select-event">Type of event *</label>
        <select
          name="type"
          required
          id="select-event"
          placeholder="Select event"
        >
          <option value="">select</option>
            <option value="Birthday"<?php if (isset($_SESSION['selected_event_type']) && $_SESSION['selected_event_type'] == 'Birthday') { echo ' selected'; } ?>>Birthday</option>
            <option value="Baby Shower"<?php if (isset($_SESSION['selected_event_type']) && $_SESSION['selected_event_type'] == 'Baby Shower') { echo ' selected'; } ?>>Baby Shower</option>
            <option value="Bachelor party"<?php if (isset($_SESSION['selected_event_type']) && $_SESSION['selected_event_type'] == 'Bachelor party') { echo ' selected'; } ?>>Bachelor party</option>
            <option value="Graduation"<?php if (isset($_SESSION['selected_event_type']) && $_SESSION['selected_event_type'] == 'Graduation') { echo ' selected'; } ?>>Graduation</option>
            <option value="Corporate event"<?php if (isset($_SESSION['selected_event_type']) && $_SESSION['selected_event_type'] == 'Corporate event') { echo ' selected'; } ?>>Corporate event</option>
            <option value="Wedding"<?php if (isset($_SESSION['selected_event_type']) && $_SESSION['selected_event_type'] == 'Wedding') { echo ' selected'; } ?>>Wedding</option>
        </select>
      </div>
      <div>
        <label for="date">Event date *</label>
        <input
          name="date"
          required
          type="date"
          placeholder="Choose event date"
          value="<?=$_SESSION['date'] ?? '' ?>"
        />
        <div>
          <label for="email">Time of Event *</label>
          <input
            name="time"
            required
            type="time"
            value="<?=$_SESSION['time'] ?? '' ?>"
          />
        </div>
      </div>
      <div>
        <label for="guests">Number of guests *</label>
        <input
          name="guests"
          required
          type="text"
          placeholder="Number of guests"
          value="<?=$_SESSION['guests'] ?? '' ?>"
        />
      </div>
      <div>
        <label for="add-info">Additional information</label>
        <textarea id="add-info" name="add-info"><?=$_SESSION['add-info'] ?? '' ?></textarea>
      </div>
      <div class="btn-form">
          <button type="submit" name="submit" class="form-btn">Book Event</button>
      </div>
      <a href="../packages.php
      " class="back"> &larr; Back<a/>
    </form>
  </body>
</html>
