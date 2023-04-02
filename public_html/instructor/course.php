<?php

include '../templates/header.php';
?>
<div class="main">
    <?php include '../templates/side-bar.php'; ?>
    <div class="main-body" id="content">

        <!-- course page navigation -->
        <!-- add course, grade, send private message -->
        <div class="course-nav">
            <a href="add-course.php">
                <div class="course-nav-item">
                    <span class="material-symbols-outlined">
                        note_add
                    </span>
                    <p>Add Course</p>
                </div>
            </a>
            <a href="">
                <div class="course-nav-item">
                    <span class="material-symbols-outlined">
                        assignment_turned_in
                    </span>
                    <p>Grade</p>
                </div>
            </a>
            <a href="">
                <div class="course-nav-item">
                    <span class="material-symbols-outlined">
                        chat
                    </span>
                    <p>Send Private Message</p>
                </div>
            </a>
        </div>

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
            <!-- pagination -->
            <div class="pagination">
                <a href="#">&laquo;</a>
                <a href="#">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#">&raquo;</a>
            </div>
        </div>

    </div>