<?php
include '../templates/header.php';

if (isset($_GET['id'])) {
    $course_id = $_GET['id'];

    // Retrieve the course data from the database
    $query = "SELECT * FROM course WHERE course_id = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'i', $course_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        echo "Course not found.";
        exit;
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Course ID not found.";
    exit;
}

if (isset($_POST['update'])) {
    $course_name = $_POST['course_name'];
    $course_description = $_POST['course_description'];
    $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : null;
    $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : null;
    $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : null;
    $is_published = isset($_POST['is_published']) ? 1 : 0;
    $image_name = substr($_POST['course_name'], 0, 10) . '.jpg';

    // Upload the image
    $image_dir = '../assets/uploads/courses'; // specify the directory where you want to save the image
    $image_file = $image_dir . $image_name;
    move_uploaded_file($_FILES['image']['tmp_name'], $image_file);

    // Create a prepared statement to update the course data
    $query = "UPDATE course SET course_name = ?, course_description = ?, start_date = ?, end_date = ?, image = ?, category_id = ?, is_published = ? WHERE course_id = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'ssssssii', $course_name, $course_description, $start_date, $end_date, $image_name, $category_id, $is_published, $course_id);

    // Execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Course updated successfully.";
    } else {
        echo "Error updating course: " . mysqli_error($link);
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);

    // Close the database link
    mysqli_close($link);

    // Redirect to the course page
    header("Location: course.php?id=$course_id");
}


?>

<div class="main">
    <?php include '../templates/side-bar.php'; ?>
    <div class="main-body" id="content">

        <h3> Edit Course </h3>
        <div class="add-course">
            <form action="edit-course.php?id=<?php echo $course_id; ?>" method="post" enctype="multipart/form-data">
                <label for="course_name">Course Name:</label>
                <input type="text" id="course_name" name="course_name" value="<?php echo $row['course_name']; ?>" required>

                <label for="course_description">Course Description:</label>
                <textarea id="course_description" name="course_description" required><?php echo $row['course_description']; ?></textarea>

                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" value="<?php echo $row['start_date']; ?>">


                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" value="<?php echo $row['end_date']; ?>">

                <label for="image">Image:</label>
                <input type="file" id="image" name="image"><br>

                <label for="category_id">Category:</label>
                <select id="category_id" name="category_id">
                    <option value="1" <?php if ($row['category_id'] == 1) echo "selected"; ?>>Web Development</option>
                    <option value="2" <?php if ($row['category_id'] == 2) echo "selected"; ?>>Mobile Development</option>
                    <option value="3" <?php if ($row['category_id'] == 3) echo "selected"; ?>>Data Science</option>
                    <option value="4" <?php if ($row['category_id'] == 4) echo "selected"; ?>>Design</option>
                    <option value="5" <?php if ($row['category_id'] == 5) echo "selected"; ?>>Business</option>
                    <option value="6" <?php if ($row['category_id'] == 6) echo "selected"; ?>>Marketing</option>
                    <option value="7" <?php if ($row['category_id'] == 7) echo "selected"; ?>>Photography</option>
                    <option value="8" <?php if ($row['category_id'] == 8) echo "selected"; ?>>Music</option>
                    <option value="9" <?php if ($row['category_id'] == 9) echo "selected"; ?>>Personal Development</option>
                </select>
                <br>
                <input type="hidden" name="id" value="<?php echo $course_id; ?>">

                <?php if ($row['is_published']) : ?>
                    <label for="is_published">Published:</label>
                    <input type="checkbox" id="is_published" name="is_published" value="1" checked><br>
                <?php else : ?>
                    <label for="is_published">Published:</label>
                    <input type="checkbox" id="is_published" name="is_published" value="1"><br>
                <?php endif; ?>

                <input type="submit" name="update" value="Update Course">
                <!-- add course content page -->
                <div id="add-cont-button">
                    <button id="button" type="button" onclick="window.location.href='add_content.php?id=<?php echo $course_id; ?>'">Add Content</button>
                </div>
                <div id="add-cont-button">
                    <button id="button" type="button" onclick="window.location.href='chapter.php?id=<?php echo $course_id; ?>'">Chapters</button>
                </div>

            </form>
        </div>


    </div>

</div>