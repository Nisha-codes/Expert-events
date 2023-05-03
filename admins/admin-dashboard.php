<?php
include '../includes/database.php';
session_start();
if(!isset($_SESSION['auth_admin'])){
header("Location:../auth/admins/signin.php");
}

$no_of_events = 0;
$no_of_users = 0;

try {
    $fetchUsersSql = "select * from users ";
    $result = mysqli_query($con,$fetchUsersSql);

    if($result){
        if ($result->num_rows > 0){
            $no_of_users = $result->num_rows;
        }
    }
} catch (mysqli_sql_exception $ex) {
    $error = 'Error encountered, try again later';

}


try {
    $fetchEventsSql = "SELECT *
                    FROM events
                    LEFT JOIN users ON events.user_id = users.id;
                    ";
    $result2 = mysqli_query($con,$fetchEventsSql);

    if($result2){
        if ($result2->num_rows > 0){
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
  <body class="admin-dash">
   <div class="container" style="margin-top: 20px;">
       <h1 class="welcome">Welcome, <?php echo $_SESSION['auth_admin']['firstname'] ?></h1>
       <div>
           <h3>Users</h3>
           <?php
            if($no_of_users){
           ?>
           <table>
               <thead>
               <tr>
                   <th>S/N</th>
                   <th>Name</th>
                   <th>Email</th>
               </tr>
               </thead>
               <tbody>
               <?php
               $count = 1;
               while ($row=mysqli_fetch_array($result)){
                   ?>
                   <tr>
                       <td><?=$count?></td>
                       <td><?=$row['full_name'] ?? '-'?></td>
                       <td><?=$row['email'] ?? '-'?></td>
                   </tr>
                   <?php
                   $count++;
               }
               ?>
               </tbody>
           </table>
           <?php
            }
            else{
           ?>
           <p style="font-size: 20px;margin-top: 20px">No user is currently registered. </p>
           <?php } ?>
       </div>
       <div>
           <h3 style="margin-top: 40px">Booked Events</h3>
           <?php
           if($no_of_events){
           ?>
           <table>
               <thead>
               <tr>
                   <th>S/N</th>
                   <th>Package type</th>
                   <th>Type of Event</th>
                   <th>Event date</th>
                   <th>Time of Event</th>
                   <th>Number of guests</th>
                   <th>Additional information</th>
                   <th>User</th>
               </tr>
               </thead>
               <tbody>
               <?php
               $count = 1;
               while ($row=mysqli_fetch_array($result2)){
               ?>
               <tr>
                   <td><?=$count?></td>
                   <td><?=$row['package'] ?? '-'?></td>
                   <td><?=$row['type'] ?? '-'?></td>
                   <td><?=$row['date'] ?? '-'?></td>
                   <td><?=$row['time'] ?? '-'?></td>
                   <td><?=$row['no_of_guests'] ?? '-'?></td>
                   <td><?=$row['additional_info']  ?: '-'?></td>
                   <td><?=$row['full_name'] ?? '-'?></td>
               </tr>
               <?php
               $count++;
               }
               ?>
               </tbody>
           </table>
               <?php
           }
           else{
               ?>
               <p style="font-size: 20px;margin-top: 20px">No event available at the moment. </p>
           <?php } ?>
       </div>
   </div>
  </body>
</html>
