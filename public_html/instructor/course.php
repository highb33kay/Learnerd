<?php

include '../templates/header.php';
?>
<div class="main">
    <?php include '../templates/side-bar.php'; ?>
    <div class="main-body" id="content">
        <div class="course-overview">
            <!-- display all courses -->

            <h2>My Courses</h2>
            <div class="course-list">
                <table class="course-table">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Course Image</th>
                            <th>Course Title</th>
                            <th>Enrolled</th>
                            <th>Status</th>
                            <th>Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><img src="course1.jpg" alt="Course 1"></td>
                            <td>Introduction to Web Development</td>
                            <td>153</td>
                            <td>Active</td>
                            <td>Web Development</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

    </div>