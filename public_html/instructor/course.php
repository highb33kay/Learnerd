<?php

include '../templates/header.php';
?>
<div class="main">
    <?php include '../templates/side-bar.php'; ?>
    <div class="main-body" id="content">
        <div class="main-body" id="content">
            <?php include '../templates/courses/course-nav.php'; ?>
            <?php
            // Retrieve the first 5 courses from the database
            $query = "SELECT course.*, course_category.name
                        FROM course
                        JOIN course_category ON course.category_id = course_category.id
                        LIMIT 5
                    ";
            $result = mysqli_query($link, $query);

            $published = '';

            // Check if there are any courses
            if (mysqli_num_rows($result) > 0) {
                // Display the courses in a table
                echo '<div class="course-overview">';
                echo '<h3>My Courses</h3>';
                echo '<div class="course-list">';
                echo '<table class="course-table">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>S/N</th>';
                echo '<th>Course Image</th>';
                echo '<th>Course Title</th>';
                echo '<th>Enrolled</th>';
                echo '<th>Status</th>';
                echo '<th>Category</th>';
                echo '<th>Change Status</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['is_published'] == 1) {
                        $published = 'Published';
                    } else {
                        $published = 'Not Published';
                    }
                    echo '<tr>';
                    echo '<td>' . $i . '</td>';
                    echo '<td><img src="../assets/uploads/' . 'courses' . $row['image'] . '" alt="' . $row['course_name'] . ' " class="course-thumbnail"></td>';
                    echo '<td>' . $row['course_name'] . '</td>';
                    echo '<td>' . 'enrolled' . '</td>';
                    echo '<td>' . $published . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td><p><a href="edit-course.php?id=' . $row['course_id'] . '">Edit Course</a></p></td>';
                    echo '</tr>';

                    $i++;
                }


                echo '</tbody>';
                echo '</table>';
                echo '</div>';

                // Display pagination links if there are more than 5 courses
                $query = "SELECT COUNT(*) AS count FROM course";
                $result = mysqli_query($link, $query);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];

                if ($count > 1) {
                    echo '<div class="pagination">';
                    echo '<a href="#">&laquo;</a>';
                    for ($i = 1; $i <= ceil($count / 5); $i++) {
                        echo '<a href="#">' . $i . '</a>';
                    }
                    echo '<a href="#">&raquo;</a>';
                    echo '</div>';
                }
                echo '</div>';
            } else {
                echo "No courses found.";
            } // Close the database link mysqli_close($link);