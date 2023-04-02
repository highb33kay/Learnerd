<?php

include '../templates/header.php';

// Initialize variables
$course_name = '';
$course_description = '';
$instructor_id = 0;
$start_date = '';
$end_date = '';
$image_name = '';
$category_id = 0;

// Check if form was submitted
if (isset($_POST['course_name'])) {
    // Retrieve the course data from the form
    $course_name = $_POST['course_name'];
    $course_description = $_POST['course_description'];
    $instructor_id = $_SESSION['user_id']; // Retrieve the instructor ID from the session or wherever you store it
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $image_name = substr($_POST['course_name'], 0, 10) . '.jpg'; // rename the image to the first 10 letters of the course name
    $category_id = $_POST['category']; // Retrieve the selected category ID

    // Upload the image
    $image_dir = '../assets/uploads/courses'; // specify the directory where you want to save the image
    $image_file = $image_dir . $image_name;
    move_uploaded_file($_FILES['image']['tmp_name'], $image_file);

    // Create a prepared statement to insert the course data
    $query = "INSERT INTO course (course_name, course_description, instructor_id, start_date, end_date, image, category_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'ssisssi', $course_name, $course_description, $instructor_id, $start_date, $end_date, $image_name, $category_id);

    // Execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Course added successfully.";
    } else {
        echo "Error adding course: " . mysqli_error($link);
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
}

// Close the database link
mysqli_close($link);

?>

<div class="main">
    <?php include '../templates/side-bar.php'; ?>
    <div class="main-body" id="content">

        <h3> Add Course </h3>
        <div class="add-course">

            <form action="add_course.php" method="post" enctype="multipart/form-data">
                <label for="course_name">Course Name:</label>
                <input type="text" id="course_name" name="course_name"><br>

                <label for="course_description">Course Description:</label>
                <textarea id="course_description" name="course_description"></textarea><br>

                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date"><br>

                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date"><br>

                <label for="image">Image:</label>
                <input type="file" id="image" name="image"><br>

                <label for="category">Category:</label>
                <select id="category" name="category">
                    <option value="1">Web Development</option>
                    <option value="2">Mobile Development</option>
                    <option value="3">Data Science</option>
                    <option value="4">Design</option>
                    <option value="5">Business</option>
                    <option value="6">Marketing</option>
                    <option value="7">Photography</option>
                    <option value="8">Music</option>
                    <option value="9">Lifestyle</option>
                    <option value="10">Health & Fitness</option>
                    <option value="11">Personal Development</option>
                    <option value="12">Teaching & Academics</option>
                </select><br>

                <input type="submit" value="Add Course">
            </form>
        </div>
    </div>
</div>