<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Expert-Events</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body class="pack">
  <?php include_once 'includes/navbar.php' ?>

    <section class="container">
      <h2 class="center-text welcome mt">Our Packages</h2>

      <div class="packages">
        <div class="package-card p1">
          <p class="package-heading">BRONZE</p>
          <p class="dollar">$<span class="price">250</span></p>
          <ul class="card-ul">
            <li class="card-list">Venue Sourcing</li>
            <li class="card-list">Catering services</li>
            <li class="card-list">
              Vendors booking
            </li>
         </ul>
          <a href="bookpackage.php" class="btn btn-nav1">Book event</a>
        </div>
        <div class="package-card p2">
          <p class="package-heading">SILVER</p>
          <p class="dollar">$ <span class="price">450</span></p>
          <ul class="card-ul">
            <li class="card-list">
              Venue Sourcing
            </li>
            <li class="card-list">
              Catering services
            </li>
            <li class="card-list">
              Vendors booking
            </li>
            <li class="card-list">
              Photography
            </li>
            Ushers
            </li>
          </ul>
          <a href="bookpackage.php" class="btn btn-nav1">Book event</a>
        </div>
        <div class="package-card p3">
          <p class="package-heading">GOLD</p>
          <p class="dollar">$ <span class="price">600</span></p>
          <ul class="card-ul">
            <li class="card-list">
              Venue sourcing
            </li>
            <li class="card-list">
              Catering services
            </li>
            <li class="card-list">
              Vendors booking
            </li>
            <li class="card-list">
              Photography
            </li>
            <li class="card-list">
              Ushers
            </li>
            <li class="card-list">
              Transportation
            </li>
          </ul>
          <a href="bookpackage.php" class="btn btn-nav1">Book event</a>
        </div>
        <div class="package-card p4">
          <p class="package-heading">PLATINUM</p>
          <p class="dollar">$<span class="price">850</span></p>
          <ul class="card-ul">
            <li class="card-list">
              Venue Sourcing
            </li>
            <li class="card-list">
              Catering services
            </li>
            <li class="card-list">
              Vendors booking
            </li>
            <li class="card-list">
              Ushers
            </li>
            <li class="card-list">
              Transportation
            </li>
            <li class="card-list">
              Gifts services
            </li>
            <li class="card-list">
              After party
            </li>
          </ul>
          <a href="bookpackage.php" class="btn btn-nav1">Book event</a>
        </div>
      </div>
    </section>
  </body>
</html>
