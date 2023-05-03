<?php
session_start();
include '../includes/database.php';
include '../includes/cleanInputs.php';
if(!isset($_SESSION['auth_user'])){
    header("Location:../auth/users/signin.php");
}


$auth_user_id = $_SESSION['auth_user']['id'];
$event_id = isset($_GET['id']) ? $_GET['id'] : null;
$guests = [];


try {
    $fetchEventSql = "SELECT events.*, GROUP_CONCAT(event_guests.id, ':', event_guests.name SEPARATOR ', ') as guests 
                        FROM events 
                        LEFT JOIN event_guests ON events.id = event_guests.event_id 
                        WHERE events.id = '$event_id' 
                        GROUP BY events.id";

    $result = mysqli_query($con,$fetchEventSql);

    if($result){
        if ($result->num_rows > 0){
           $event = mysqli_fetch_assoc($result);
            if(isset( $event['guests'])){
                $guests = explode(',', $event['guests']);
            }
        }
    }
} catch (mysqli_sql_exception $ex) {
    echo "
          <script type=\"text/javascript\">
             alert('Error encountered, try again later');
            window.location=''
          </script>";

}

// Add guest
if (isset($_POST['submit'])){

   $guest_name = $_POST['guest_name'];
   if ($guest_name){

       $cleanGuestName = cleanUserInput($_POST['guest_name']);

       // Insert guest
       try {
           $InsertSql = "insert into event_guests (name,event_id) values('$cleanGuestName','$event_id')";
           $insert = mysqli_query($con,$InsertSql);

           if($insert){
               echo "
                      <script type=\"text/javascript\">
                         alert('Guest has been added successfully!');
                        window.location=''
                      </script>";
           }
           else{
               echo "Failed";
           }
       } catch (mysqli_sql_exception $ex) {
            echo "
                      <script type=\"text/javascript\">
                         alert('Error encountered, try again later');
                        window.location=''
                      </script>";

       }
   }

}

// Remove guest
if (isset($_GET['guest_id'])  && isset($_GET['action'])){

    $guest_id = $_GET['guest_id'];
    $action   = $_GET['action'];

    if ($action === 'remove'){
        try {
            $deleteSql = "delete from event_guests where id = '$guest_id' ";

            $delete = mysqli_query($con,$deleteSql);

            if($delete){
                echo "
                      <script type=\"text/javascript\">
                         alert('Guest was removed successfully');
                        window.location='event.php?id=$event_id'
                      </script>";
            }
        } catch (mysqli_sql_exception $ex) {
            echo "
                      <script type=\"text/javascript\">
                         alert('Error encountered, try again later');
                        window.location=''
                      </script>";

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
<body class="userpage">
<div class="container" style=" margin-top: 20px;">
    <h1 class="welcome">Welcome, <?php echo $_SESSION['auth_user']['firstname'] ?></h1>
    <div>
        <h3>Event details</h3>
        <div class="event-details">
            <div class="event-row">
                <div class="event-column">
                    <div><b>Type of Event</b>: <p class="value"><?=$event['package']?></p></div>
                </div>

                <div class="event-column">
                    <div><b>Event date</b>:  <p class="value"><?=$event['date']?></p></div>
                </div>

                <div class="event-column">
                    <div><b>Time of Event:</b>  <p class="value"><?=$event['time']?></p></div>
                </div>
            </div>
            <div class="event-row">
                <div class="event-column">
                    <div><b>Number of guests:</b>  <p class="value"><?=$event['no_of_guests']?></p></div>
                </div>
                <div class="event-column">
                    <div><b>Additional information:</b> <p class="value"><?=$event['additional_info']?></p></div>
                </div>
                <div class="event-column">

                </div>
            </div>
        </div>

    </div>
    <div style="margin-top: 20px">
        <h3>My Guests</h3>
        <form method="post" action="">
            <table>
                <thead>
                <tr class="thead">
                    <th>Name of Guest</th>
                    <th>Manage</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <input type="text" required class="guest-name" name="guest_name" placeholder="Type guest name" />
                    </td>
                    <td>
                        <button type="submit" class="form-btn guest-btn" name="submit">Add guest</button>
                    </td>
                </tr>
                <?php
                    foreach ($guests as $guest){
                        list($guest_id, $guest_name) = explode(':', $guest);
                      ?>
                <tr>
                    <td><?=$guest_name ?? '-'?></td>
                    <td >
                        <a style="text-decoration:none" href="event.php?id=<?=$event_id?>&guest_id=<?=$guest_id?>&action=remove" >Remove</a>
                    </td>
                </tr>
                <?php
                    }
                    ?>
                </tbody>
            </table>
        </form>



    </div>


</div>
</body>
</html>
