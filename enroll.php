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

</html>


<?php
require_once 'secureheader.php';
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
        // Loop through the selected courses and check if the class has more than one student
        foreach ($selectedCourses as $courseId) {
            $courseId = $con->real_escape_string($courseId);

            // Check if the class has more than one student
            $checkClassQuery = "SELECT COUNT(*) as studentsCount FROM `Student_Data`.`tblEnrollment` WHERE `course_id` = '$courseId'";
            $result = $con->query($checkClassQuery);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $studentsCount = $row['studentsCount'];

                if ($studentsCount > 10) {
                    // Add the student to the waitlist
                    $waitlistQuery = "INSERT INTO `Student_Data`.`tblWaitlist` (`user_id`, `course_id`) VALUES ('$userId', '$courseId')";
                    $con->query($waitlistQuery);

                    $enrollmentStatus = "Class has more than one student. You've been added to the waitlist for this class.";
                } else {
                    // Class has one or zero students, proceed with enrollment
                    $enrollQuery = "INSERT INTO `Student_Data`.`tblEnrollment` (`user_id`, `course_id`) VALUES ('$userId', '$courseId')";
                    $con->query($enrollQuery);

                    $enrollmentStatus = "Enrollment successful!";
                }
            } else {
                echo "Error checking class enrollment status.";
            }
        }
    } else {
        $enrollmentStatus = "Error: User ID is not set.";
    }
}

// Fetch available courses from tblCourse
$result = $con->query("SELECT course_id, course_name FROM `Student_Data`.`tblCourse`");

// Check if there are any rows in the result
if ($result->num_rows > 0) {
    echo '<form method="post" action="">';
    echo '<table border="1" align="center">';
    echo '<tr>';
    echo '<th>Course ID</th>';
    echo '<th>Class Name</th>';
    echo '<th>Enroll</th>';
    echo '</tr>';

    // Display dynamic table rows for available courses
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['course_id'] . '</td>';
        echo '<td>' . $row['course_name'] . '</td>';
        echo '<td><input type="checkbox" name="courses[]" value="' . $row['course_id'] . '"></td>';
        echo '</tr>';
    }

    echo '</table>';
    echo '<br>';
    echo '<input type="submit" value="Enroll">';
    echo '</form>';

    // Display enrollment status
    if (isset($enrollmentStatus)) {
        echo '<p>' . $enrollmentStatus . '</p>';
    }
}

// Close the database connection
$con->close();
?>


<?php require_once 'securefooter.php'; ?>