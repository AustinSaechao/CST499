<?php
require_once 'secureheader.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Welcome Home</title>
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <div class="form">
        <p>Welcome <?php echo $_SESSION['username']; ?>!</p>
        <p>This is the secure area of the Student Enrollment Portal.</p>
    </div>


</body>


<?php
include("db.php");

// Get the user's ID from the session
$userId = $_SESSION['user_id'];

// Fetch the user ID from tblUser based on the username (you need to adjust this based on your actual structure)
$username = $_SESSION['username'];
$resultUser = $con->query("SELECT user_id FROM `Student_Data`.`tblUser` WHERE username = '$username'");

if ($resultUser->num_rows > 0) {
    $userRow = $resultUser->fetch_assoc();
    $userId = $userRow['user_id'];
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assuming you have a form with checkboxes for each course
    // and the form is submitted when the user selects courses

    // Get the selected courses from the form
    $selectedCourses = $_POST['courses'] ?? [];

    if ($userId !== null) {
        // Loop through the selected courses and remove enrollment records from the database
        foreach ($selectedCourses as $courseId) {
            $courseId = $con->real_escape_string($courseId);

            // Assuming you have a table named 'tblEnrollment' with columns 'user_id' and 'course_id'
            $sql = "DELETE FROM `Student_Data`.`tblEnrollment` WHERE `user_id` = '$userId' AND `course_id` = '$courseId'";

            if ($con->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $con->error;
            }
        }
        $enrollmentStatus = "Course drop successful!";
    } else {
        $enrollmentStatus = "Error: User ID is not set.";
    }
}

// Fetch enrolled courses for the user
$enrollmentQuery = "SELECT e.course_id, c.course_name FROM `tblEnrollment` e
                    JOIN `tblCourse` c ON e.course_id = c.course_id
                    WHERE e.user_id = '$userId'";
$enrollmentResult = $con->query($enrollmentQuery);

// Display enrolled courses in the drop-down list
if ($enrollmentResult->num_rows > 0) {
    echo '<form method="post" action="">';
    echo '<table border="1" align="center">';
    echo '<tr>';
    echo '<th>Course ID</th>';
    echo '<th>Class Name</th>';
    echo '<th>Drop</th>';
    echo '</tr>';

    // Display dynamic table rows for enrolled courses
    while ($row = $enrollmentResult->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['course_id'] . '</td>';
        echo '<td>' . $row['course_name'] . '</td>';
        echo '<td><input type="checkbox" name="courses[]" value="' . $row['course_id'] . '"></td>';
        echo '</tr>';
    }

    echo '</table>';
    echo '<br>';
    echo '<input type="submit" value="Drop">';
    echo '</form>';

    // Display drop status
    if (isset($enrollmentStatus)) {
        echo '<p>' . $enrollmentStatus . '</p>';
    }
}

// Close the database connection
$con->close();
?>




<?php require_once 'securefooter.php'; ?>

