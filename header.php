<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('session.use_only_cookies', '1');
session_start();
if (isset($_SESSION['username']))
  echo "Login: " . $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maxmimum-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <div class="jumbotron">
    <div class="containter text-center">
      <h1>Class Enrollment</h1>

      <style>
        .navbar {
          background-color: #333;
          /* Set the background color of the navbar */
          overflow: hidden;
          /* Hide any overflow content */
        }

        .menu {
          list-style: none;
          /* Remove the bullets from the list */
          margin: 0;
          /* Remove the margin from the list */
          padding: 0;
          /* Remove the padding from the list */
          display: flex;
          /* Use flexbox to align the menu items horizontally */
          justify-content: space-between;
          /* Add space between the menu items */
        }

        .menu li {
          margin: 0 10px;
          /* Add a margin between the menu items */
        }

        .menu li a {
          display: block;
          /* Make the links display as blocks */
          color: white;
          /* Set the color of the links */
          text-align: center;
          /* Center the text in the links */
          padding: 14px 16px;
          /* Add some padding to the links */
          text-decoration: none;
          /* Remove the underline from the links */
        }

        .menu li a:hover {
          background-color: #111;
          /* Add a background color when hovering over a link */
        }
      </style>

      <nav class="navbar">
        <ul class="menu">
          <li><a href="index.php">Home</a></li>
          <li><a href="contactus.php">Contact Us</a></li>
          <li><a href="login.php">Login</a></li>
          <li><a href="registration.php">Registration</a></li>
        </ul>
      </nav>


    </div>
  </div>
  </nav>
</body>

</html>
