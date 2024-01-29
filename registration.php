<?php require_once 'header.php'; ?>
</br>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registration</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php
    require('db.php');

    // If form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($con, $username);
        $email = stripslashes($_REQUEST['email']);
        $email = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $confirmpassword = stripslashes($_REQUEST['confirmpassword']);
        $confirmpassword = mysqli_real_escape_string($con, $confirmpassword);
        $firstname = stripslashes($_REQUEST['firstname']);
        $firstname = mysqli_real_escape_string($con, $firstname);
        $lastname = stripslashes($_REQUEST['lastname']);
        $lastname = mysqli_real_escape_string($con, $lastname);
        $phone = stripslashes($_REQUEST['phone']);
        $phone = mysqli_real_escape_string($con, $phone);
        $studentID = stripslashes($_REQUEST['studentID']); // Added line
        $studentID = mysqli_real_escape_string($con, $studentID); // Added line

        if ($password != $confirmpassword) {
            echo "<div class='form'><h3>Passwords do not match. Click on the back button and enter the password again!</h3></div>";
        } else {
            $trn_date = date("Y-m-d H:i:s");
            $query = "INSERT into `tblUser` (username, password, email, firstname, lastname, phone, studentID, trn_date) VALUES ('$username', '$password', '$email', '$firstname', '$lastname', '$phone', '$studentID', '$trn_date')";
            $result = mysqli_query($con, $query);

            if ($result) {
                echo "<div class='form'><h3>You are registered successfully.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
            }
        }
    } else {
?>

<div class="form">
    <h1>Registration</h1>
    <form name="registration" action="" method="post">
        <label for="username">Username:</label><br>
        <input type="text" name="username" placeholder="Username" required /><br>

        <label for="email">Email:</label><br>
        <input type="email" name="email" placeholder="Email" required /><br>

        <label for="password">Password:</label><br>
        <input type="password" name="password" placeholder="Password" required /><br>

        <label for="confirm_password">Confirm Password:</label><br>
        <input type="password" name="confirmpassword" placeholder="Confirm Password" required /><br>

        <label for="firstname">First Name:</label><br>
        <input type="text" name="firstname" placeholder="Firstname" required /><br>

        <label for="lastname">Last Name:</label><br>
        <input type="text" name="lastname" placeholder="Lastname" required /><br>

        <label for="phone">Phone:</label><br>
        <input type="text" name="phone" placeholder="Phone" required /><br>

        <label for="studentID">Student ID:</label><br> 
        <input type="text" name="studentID" placeholder="Student ID" required /><br> 

        <input type="submit" name="submit" value="Register" />
    </form>
    <br /><br />
</div>

<br /><br />

<?php } ?>
</body>
</html>

<br>
<?php require_once 'footer.php'; ?>
