<?php require_once 'secureheader.php'; ?>


</br>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile Lookup</title>
</head>
<body>
    <form method="post" action="userinfo.php">
        <label for="username">Enter Username:</label>
        <input type="text" id="username" name="username" required>
        <button type="submit" name="submit">Search</button>
    </form>
    <br>
    <a href="index2.php">Back to Index</a>
    
</body>
</html>


<?php require_once 'securefooter.php'; ?>
