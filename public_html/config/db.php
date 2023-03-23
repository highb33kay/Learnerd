<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, 'learnerd');

if (!$conn) {
    die('Connection to DB Failed' . mysqli_error());
}

echo 'Connected successfully';

// $sql1 = "CREATE TABLE IF NOT EXISTS instructor (
//         instructor_id INT NOT NULL AUTO_INCREMENT,
//         first_name VARCHAR(100) NOT NULL,
//         last_name VARCHAR(100) NOT NULL,
//         instructor_email VARCHAR(100) NOT NULL,
//         PRIMARY KEY (instructor_id)
//     )";

// $sql2 = "CREATE TABLE IF NOT EXISTS student (
//         student_id INT NOT NULL AUTO_INCREMENT,
//         first_name VARCHAR(100) NOT NULL,
//         last_name VARCHAR(100) NOT NULL,
//         student_email VARCHAR(100) NOT NULL,
//         PRIMARY KEY (student_id)
//     )";

// $sql3 = "CREATE TABLE IF NOT EXISTS course (
//         course_id INT NOT NULL AUTO_INCREMENT,
//         course_name VARCHAR(100) NOT NULL,
//         course_description VARCHAR(100) NOT NULL,
//         instructor_id INT NOT NULL,
//         start_date DATE NOT NULL,
//         end_date DATE NOT NULL,
//         PRIMARY KEY (course_id),
//         FOREIGN KEY (instructor_id) REFERENCES instructor(instructor_id)
//     )";

// $sql4 = "CREATE TABLE IF NOT EXISTS student_course (
//         student_id INT NOT NULL,
//         course_id INT NOT NULL,
//         PRIMARY KEY (student_id, course_id),
//         FOREIGN KEY (student_id) REFERENCES student(student_id),
//         FOREIGN KEY (course_id) REFERENCES course(course_id)
//     )";

// $sql5 = "CREATE TABLE IF NOT EXISTS assignment (
//         assignment_id INT NOT NULL AUTO_INCREMENT,
//         assignment_name VARCHAR(100) NOT NULL,
//         assignment_description VARCHAR(100) NOT NULL,
//         course_id INT NOT NULL,
//         due_date DATE NOT NULL,
//         PRIMARY KEY (assignment_id),
//         FOREIGN KEY (course_id) REFERENCES course(course_id)
//     )";

// $sql6 = "CREATE TABLE IF NOT EXISTS grade (
//         grade_id INT NOT NULL AUTO_INCREMENT,
//         student_id INT NOT NULL,
//         course_id INT NOT NULL,
//         assignment_id INT NOT NULL,
//         grade DECIMAL(5,2) NOT NULL,
//         PRIMARY KEY (grade_id),
//         FOREIGN KEY (student_id) REFERENCES student(student_id),
//         FOREIGN KEY (course_id) REFERENCES course(course_id),
//         FOREIGN KEY (assignment_id) REFERENCES assignment(assignment_id)
//     )";

// $sql7 = "CREATE TABLE IF NOT EXISTS submission (
//         submission_id INT NOT NULL AUTO_INCREMENT,
//         student_id INT NOT NULL,
//         assignment_id INT NOT NULL,
//         submission_date DATE NOT NULL,
//         submission_grade INT NOT NULL,
//         PRIMARY KEY (submission_id),
//         FOREIGN KEY (student_id) REFERENCES student(student_id),
//         FOREIGN KEY (assignment_id) REFERENCES assignment(assignment_id),
//         FOREIGN KEY (submission_grade) REFERENCES grade(grade_id)
//     )";

// if (
//     mysqli_query($conn, $sql1) &&
//     mysqli_query($conn, $sql2) &&
//     mysqli_query($conn, $sql3) &&
//     mysqli_query($conn, $sql4) &&
//     mysqli_query($conn, $sql5) &&
//     mysqli_query($conn, $sql6) &&
//     mysqli_query($conn, $sql7)
// ) {
//     echo 'Databases created successfully';
// } else {
//     echo 'Error creating table: ' . mysqli_error($conn);
// }

mysqli_close($conn);

