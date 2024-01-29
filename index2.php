<br><?php require_once 'secureheader.php'; ?></br>



<?php include("auth.php"); //include auth.php file on all secure pages ?>

<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" href="css/style.css" />
</head>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome Home</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
<p>Welcome <?php echo $_SESSION['username']; ?>!</p>
<p>This is secure area of the Student Enrollment Portal.</p>





<br /><br /><br /><br />





</div>
</body>
</html>

</br>
</br>
<?php require_once 'securefooter.php'; ?>