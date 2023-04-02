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
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $i . '</td>';
                    echo '<td><img src="../assets/uploads/' . $row['image'] . '" alt="' . $row['course_name'] . '"></td>';
                    echo '<td>' . $row['course_name'] . '</td>';
                    echo '<td>' . 'enrolled' . '</td>';
                    echo '<td>' . 'status' . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
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