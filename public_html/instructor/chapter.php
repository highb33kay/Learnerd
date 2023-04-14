<?php

include '../templates/header.php';
?>

<div class="main">
    <?php include '../templates/side-bar.php'; ?>
    <div class="main-body" id="content">
        <?php include '../templates/courses/chapter-nav.php'; ?>

        <!-- get course id -->
        <?php
        $course_id = $_GET['id'];
        ?>

        <?php
        // Retrieve the first 5 chapters from the database
        $query = "SELECT * FROM chapters LIMIT 5";
        $result = mysqli_query($link, $query);


        // Check if there are any chapters
        if (mysqli_num_rows($result) > 0) {
            // Display the chapters in a table
            echo '<div class="course-overview">';
            echo "<h3> My Chapters </h3>";
            echo "<div class='course-list'>";
            echo "<table class='course-table'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>S/N</th>";
            echo "<th>Chapter Title</th>";
            echo "<th>Chapter Description</th>";
            echo "<th>Edit Chapter</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            $i = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $i . "</td>";
                echo "<td>" . $row['chapter_title'] . "</td>";
                echo "<td>" . $row['chapter_description'] . "</td>";
                echo "<td><p><a href='edit-chapter.php?course_id=$course_id&id={$row['id']}'>Edit Chapter</a></p></td>";
                echo "</tr>";

                $i++;
            }

            echo "</tbody>";
            echo "</table>";
            echo '</div>';
            echo '</div>';


            // Free the result set
            mysqli_free_result($result);
        } else {
            echo "<p class='lead'><em>No chapters were found.</em></p>";
        }
        ?>

        <?php include 'add_chapter.php' ?>
    </div>


</div>