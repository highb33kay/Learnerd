<!-- <?php

        include '../templates/header.php';

        // retrive the course data from the database
        $course_id = $_GET['course_id'];
        $query = "SELECT * FROM course WHERE course_id = $course_id";

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
</div> -->