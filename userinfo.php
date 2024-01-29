<?php
require_once 'secureheader.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>My Classes</title>
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <div class="form">
        <p>Welcome <?php echo $_SESSION['username']; ?>!</p>
        <p>This is the secure area of the Student Enrollment Portal.</p>
    </div>

    <?php
    include("db.php");

    // Get the user's ID from the session
    $userId = $_SESSION['user_id'];

    // Fetch the user ID from tblUser based on the username
    $username = $_SESSION['username'];
    $resultUser = $con->query("SELECT user_id FROM `Student_Data`.`tblUser` WHERE username = '$username'");

    if ($resultUser->num_rows > 0) {
        $userRow = $resultUser->fetch_assoc();
        $userId = $userRow['user_id'];
    }

    // Fetch enrolled classes
    $enrolledClassesQuery = "SELECT tblCourse.course_id, course_name FROM `Student_Data`.`tblEnrollment`
                            INNER JOIN `Student_Data`.`tblCourse` ON tblEnrollment.course_id = tblCourse.course_id
                            WHERE user_id = '$userId'";
    $enrolledClassesResult = $con->query($enrolledClassesQuery);

    // Fetch dropped classes
    $droppedClassesQuery = "SELECT tblCourse.course_id, course_name FROM `Student_Data`.`tblDrop`
                            INNER JOIN `Student_Data`.`tblCourse` ON tblDrop.course_id = tblCourse.course_id
                            WHERE user_id = '$userId'";
    $droppedClassesResult = $con->query($droppedClassesQuery);

    // Fetch waitlisted classes
    $waitlistQuery = "SELECT tblCourse.course_id, course_name FROM `Student_Data`.`tblWaitlist`
                        INNER JOIN `Student_Data`.`tblCourse` ON tblWaitlist.course_id = tblCourse.course_id
                        WHERE user_id = '$userId'";
    $waitlistResult = $con->query($waitlistQuery);
    ?>

    <div class="form">
        <h1>My Classes</h1>

        <h2>Enrolled Classes</h2>
        <?php
        if ($enrolledClassesResult->num_rows > 0) {
            echo '<table border="1">';
            echo '<tr><th>Course ID</th><th>Course Name</th></tr>';
            while ($row = $enrolledClassesResult->fetch_assoc()) {
                echo '<tr><td>' . $row['course_id'] . '</td><td>' . $row['course_name'] . '</td></tr>';
            }
            echo '</table>';
        } else {
            echo '<p>No enrolled classes.</p>';
        }
        ?>

        <h2>Dropped Classes</h2>
        <?php
        if ($droppedClassesResult->num_rows > 0) {
            echo '<table border="1">';
            echo '<tr><th>Course ID</th><th>Course Name</th></tr>';
            while ($row = $droppedClassesResult->fetch_assoc()) {
                echo '<tr><td>' . $row['course_id'] . '</td><td>' . $row['course_name'] . '</td></tr>';
            }
            echo '</table>';
        } else {
            echo '<p>No dropped classes.</p>';
        }
        ?>

        <h2>Waitlisted Classes</h2>
        <?php
        if ($waitlistResult->num_rows > 0) {
            echo '<table border="1">';
            echo '<tr><th>Course ID</th><th>Course Name</th></tr>';
            while ($row = $waitlistResult->fetch_assoc()) {
                echo '<tr><td>' . $row['course_id'] . '</td><td>' . $row['course_name'] . '</td></tr>';
            }
            echo '</table>';
        } else {
            echo '<p>No waitlisted classes.</p>';
        }
        ?>
    </div>

</body>

<?php require_once 'securefooter.php'; ?>
</html>
