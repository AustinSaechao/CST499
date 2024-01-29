-- Create schema for student data
CREATE SCHEMA IF NOT EXISTS `Student_Data`;

-- Table for User Information
CREATE TABLE IF NOT EXISTS `tblUser` (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL, -- Use a longer length for password hashing
    email VARCHAR(50) NOT NULL,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    studentID INT, -- You may want to add UNIQUE constraint if studentID should be unique
    trn_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table for Course Information
CREATE TABLE IF NOT EXISTS `tblCourse` (
    course_id VARCHAR(11) PRIMARY KEY,
    course_name VARCHAR(100) NOT NULL
);

-- Insert sample courses into the 'tblCourse' table if they don't exist
INSERT INTO `tblCourse` (course_id, course_name) VALUES
('CST301', 'Software Technology & Design'),
('CST304', 'Software Requirements & Analysis'),
('CST307', 'Software Architecture & Design'),
('CST310', 'Software Development'),
('CST313', 'Software Testing'),
('CST316', 'Information Security Management'),
('CST499', 'Capstone for Computer Software Technology');

-- Index for studentID in tblUser
CREATE INDEX IF NOT EXISTS idx_studentID ON `tblUser` (studentID);

-- Table for Enrollment
CREATE TABLE IF NOT EXISTS `tblEnrollment` (
    enrollment_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    course_id VARCHAR(10) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES `tblUser`(user_id),
    FOREIGN KEY (course_id) REFERENCES `tblCourse`(course_id)
);

-- Table for Waitlist
CREATE TABLE IF NOT EXISTS `tblWaitlist` (
    waitlist_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    course_id VARCHAR(10),
    FOREIGN KEY (user_id) REFERENCES `tblUser`(user_id),
    FOREIGN KEY (course_id) REFERENCES `tblCourse`(course_id)
);

-- Table for Dropped Courses
CREATE TABLE IF NOT EXISTS `tblDrop` (
    drop_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    course_id VARCHAR(10),
    FOREIGN KEY (user_id) REFERENCES `tblUser`(user_id),
    FOREIGN KEY (course_id) REFERENCES `tblCourse`(course_id)
);
