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
  <body>
   <?php include_once 'includes/navbar.php'?>
    <div class="section-hero">
      <div class="overlay">
        <h1>
          <em><marquee>Life is an Event, Make it Memorable!</marquee></em>
        </h1>
        <p>From start up to Clean up, be a guest at your own event.</p>
      </div>
    </div>
    <section class="events-section">
      <p class="top-events">OUR TOP EVENTS</p>
      <div class="events">
        <figure class="gallery">
          <img src="img/chuttersnap-aEnH4hJ_Mrs-unsplash.jpg" alt="" />
        </figure>
        <figure class="gallery">
          <img src="img/jordan-arnold-Ul07QK2AR-0-unsplash.jpg" alt="" />
        </figure>
        <figure class="gallery">
          <img src="img/thomas-william-OAVqa8hQvWI-unsplash.jpg" alt="" />
        </figure>
        <figure class="gallery">
          <img src="img/enmanuel-betances-santos-ZZybvrJA8uo-unsplash.jpg" alt="" />
        </figure>
        <figure class="gallery">
          <img src="img/photos-by-lanty-O38Id_cyV4M-unsplash.jpg" alt="" />
        </figure>
        <figure class="gallery">
          <img src="img/luis-monse-uFUQcnUdMWw-unsplash.jpg" alt="" />
        </figure>
      </div>
    </section>
    <section class="section-testimonials" >
      <div class="testimonials-container">
        <h3 class="center-text">Testimonials</h3>
        <h2 class="center-text">
      What our customers are saying</h2>

      <div class="testimonials">
        <figure class="testimonial">
          <img class="testimonial-img" src="img/hannah.jpg" alt="customer" />
          <blockquote class="testimonial-text">
            I have no regrets. My wedding day was handles impeaccably from start to finish!
          </blockquote>
          <p class="testimonial-name">&mdash; Hannah Smith</p>
        </figure>
        <figure class="testimonial">
          <img class="testimonial-img" src="img/dave.jpg" alt="customer" />
          <blockquote class="testimonial-text">
            The little personal details meant alot to my spouse and I. I'm glad i decided to work with you.</blockquote>
          <p class="testimonial-name">&mdash; Dave Hadley</p>
        </figure>
        <figure class="testimonial">
          <img class="testimonial-img" src="img/steve.jpg" alt="customer" />
          <blockquote class="testimonial-text">
          Expert events absolutely smashed it, the most amazing bachelor party ever, with little to no input from us. </blockquote>
          <p class="testimonial-name">&mdash; Steve Miller</p>
        </figure>
        <figure class="testimonial">
          <img class="testimonial-img" src="img/sandra.jpg" alt="customer" />
          <blockquote class="testimonial-text">
            The venue, the food, the artwork, everything looked amazing.Thank you for the stellar work.</blockquote>
          <p class="testimonial-name">&mdash; Sandra Oh</p>
        </figure>
      </div>
    </div>
    </section>
    </main>
    <footer>
      <div class="footer">
        <p class="copyright">
          Copyright &copy; 2023 Expert Events, Inc. <br />All rights reserved.<br /><br />
          by Techies Ltd
        </p>
          <div>
            <p class="footer-heading">ACCOUNT</p>
            <ul class="footer-list">
            <li><a class="footer-link" href="signup.php">Create Account</a></li>
            <li><a class="footer-link" href="Login.html">Log In </a></li>
            </ul>
          </div>
        <div>
          <p class="footer-heading">ABOUT US</p>
          <ul class="footer-list">
            <li><a class="footer-link" href="#">History</a></li>
            <li><a class="footer-link" href="#">Affiliates </a></li>
          </ul>
        </div>
        <div>
          <p class="footer-heading">CONTACT US</p>
          <address>
            <p>123 Computing Dept Sheffield Hallam University.</p>
          </address>
          <p>
            <a class="footer-link" href="tel:">+44-2345-6789</a><br />
            <a class="footer-link" href="mailto:">hello@expertevents.com</a>
          </p>
        </div>
      </div>
    </footer>
  </body>
</html>
