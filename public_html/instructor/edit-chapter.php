<?php
include '../templates/header.php';

$course_id = $_GET['course_id'];


if (isset($_GET['id'])) {
    $course_id = $_GET['course_id'];
    $id = $_GET['id'];

    // Retrieve the chapter data from the database
    $query = "SELECT * FROM chapters WHERE course_id = ? AND id = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'ii', $course_id, $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);


    if (!$row) {
        echo "Chapter not found. " . mysqli_connect_error();
        exit;
    }



    mysqli_stmt_close($stmt);
} else {

    echo "Chapter not found. " . mysqli_connect_error();
    exit;
}

if (isset($_POST['update'])) {
    $chapter_title = $_POST['chapter_title'];
    $chapter_description = $_POST['chapter_description'];


    // Create a prepared statement to update the selected course data
    $query = "UPDATE chapters SET chapter_title = ?, chapter_description = ? WHERE course_id = ? AND id = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'ssii', $chapter_title, $chapter_description, $course_id, $id);


    // Execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Chapter updated successfully.";
    } else {
        echo "Error updating chapter: " . mysqli_error($link);
    }

    // // Redirect to the course page
    // header("Location: chapter.php?id=' . $row['id'] . '");
}

?>

<div class="main">
    <?php include '../templates/side-bar.php'; ?>
    <div class="main-body" id="content">

        <h3> Edit Chapter </h3>
        <div class="add-course">
            <form action="edit-chapter.php?course_id=<?php echo $course_id; ?>&id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">


                <label for="course_name">Course Name:</label>
                <input type="text" id="course_name" name="chapter_title" value="<?php echo $row['chapter_title']; ?>" required>

                <label for="course_description">Course Description:</label>
                <textarea id="course_description" name="chapter_description" required><?php echo $row['chapter_description']; ?></textarea>

                <input type="hidden" name="id" value="<?php echo $course_id; ?>">

                <input type="submit" name="update" value="Update Chapter">
                <!-- add course content page -->
                <div id="add-cont-button">
                    <button id="button" type="button" onclick="window.location.href='add_content.php?id=<?php echo $course_id; ?>'">Add Content</button>
                </div>
                <div id="add-cont-button">
                    <button id="button" name="update" type="button" onclick="window.location.href='chapter.php?id=<?php echo $course_id; ?>'">Chapters</button>
                </div>

            </form>
        </div>


    </div>

</div>