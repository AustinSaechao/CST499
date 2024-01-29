<?php
error_reporting(E_ALL ^ E_NOTICE)
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

<div class="navbar-fixed-bottom row-fluid">
  <div class="navbar-inner">
    <div class="containter text-center">
      Copyright @ 2024
    </div>
  </div>
</div>


<style>
    .navbar {
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #f8f8f8;
      height: 50px;
      border: 1px solid #ccc;
    }

    .menu {
      list-style-type: none;
      margin: 0;
      padding: 0;
      display: flex;
    }

    .menu li {
      margin: 0 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .menu li a {
      display: block;
      padding: 10px;
      text-decoration: none;
      color: #333;
    }

    .menu li a:hover {
      background-color: #ccc;
    }


    .menu li a:hover {
      background-color: #111;
      /* Add a background color when hovering over a link */
    }
  </style>

  <nav class="navbar">
    <ul class="menu">
      <li><a href="index2.php">Home</a></li>
      <li><a href="contactus.php">Contact Us</a></li>
      <li><a href="registration.php">Registration</a></li>
      <li><a href="enroll.php">Add Class</a></li>
      <li><a href="drop.php">Drop Class</a></li>
      <li><a href="userinfo.php">Student Record</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </nav>




</body>
</html>
  