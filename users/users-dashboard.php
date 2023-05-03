<?php
session_start();
include '../includes/database.php';
if(!isset($_SESSION['auth_user'])){
    header("Location:../auth/users/signin.php");
}


$auth_user_id = $_SESSION['auth_user']['id'];
$no_of_events = 0;

try {
    $fetchEventsSql = "select * from events where user_id = '$auth_user_id' ";
    $result = mysqli_query($con,$fetchEventsSql);

    if($result){
        if ($result->num_rows > 0){
            $no_of_events = $result->num_rows;
        }
    }
} catch (mysqli_sql_exception $ex) {
    $error = 'Error encountered, try again later';

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
          <h3>Booked Events</h3>
          <?php
            if ($no_of_events){
          ?>
          <table>
              <thead>
              <tr class="thead">
                  <th>S/N</th>
                  <th>Type of Event</th>
                  <th>Event date</th>
                  <th>Time of Event</th>
                  <th>Number of guests</th>
                  <th>Additional Information</th>
                  <th>Action</th>
              </tr>
              </thead>
              <tbody>
              <?php
                $count = 1;
                while ($row=mysqli_fetch_array($result)){
              ?>
              <tr>
                  <td><?=$count?></td>
                  <td><?=$row['type'] ?? '-'?></td>
                  <td><?=$row['date'] ?? '-'?></td>
                  <td><?=$row['time'] ?? '-'?></td>
                  <td><?=$row['no_of_guests'] ?? '-'?></td>
                  <td><?=$row['additional_info']  ?: '-'?></td>
                  <td class="view-link"><a href="event.php?id=<?=$row['id']?>" >View</a></td>
              </tr>
              <?php
                    $count++;
                }
              ?>
              </tbody>
          </table>
          <?php
            } else{
            ?>
          <p style="font-size: 20px;margin-top: 20px">You currently have no booked events. </p>
          <?php
            }
          ?>
      </div>
  </div>
  </body>
</html>
