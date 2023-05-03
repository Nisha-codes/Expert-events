<?php
session_start();
if(!isset($_SESSION['auth_user'])){
    header("Location:../auth/users/signin.php");
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
      <h1 class="welcome">Welcome, Nisha</h1>
      <div>
          <h3>Booked Events</h3>
          <table>
              <thead>
              <tr class="thead">
                  <th>Type of Event</th>
                  <th>Event date</th>
                  <th>Time of Event</th>
                  <th>Number of guests</th>
                  <th>Additional information</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                  <td><a href="../guests.html" /> Wedding</td>
                  <td>02/07/2023</td>
                  <td>14:00</td>
                  <td>100</td>
                  <td>Nil</td>
              </tr>
              </tbody>
          </table>
      </div>
  </div>
  </body>
</html>
