<?php

include '../templates/header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// get course id from url
if (isset($_GET['id'])) {
    $course_id = $_GET['id'];
}

// Get form data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $course_id = $_POST['course_id'];
    $chapter_id = $_POST['chapter_id'];
    $chapter_title = $_POST['chapter_title'];
    $chapter_description = $_POST['chapter_description'];

    // Validate user authorization
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM course WHERE course_id = ? AND instructor_id = ?";
    $stmt = $link->prepare($query);
    $stmt->bind_param('ii', $course_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        echo "You are not authorized to edit this course.";
        exit;
    }


    // Add or update chapter in database

    $query = "INSERT INTO chapters (course_id, chapter_title, chapter_description) VALUES (?, ?, ?)";
    $stmt = $link->prepare($query);
    $stmt->bind_param('iss', $course_id, $chapter_title, $chapter_description);
    $stmt->execute();



    header('Location: add_chapter.php?id=' . $course_id);
    exit;
}

?>
<?php echo $user_id; ?>
<form method="post" action="add_chapter.php">
    <input type="hidden" name="course_id" value="<?php echo $course_id ?>">

    <input type="hidden" name="chapter_id" value="<?php echo $chapter_id ?>"> <!-- Leave blank for new chapters, or replace with existing chapter ID -->
    <label for="chapter_title">Chapter Title:</label>
    <input type="text" name="chapter_title" id="chapter_title" required>
    <label for="chapter_description">Chapter Description:</label>
    <textarea name="chapter_description" id="chapter_description" required></textarea>
    <button type="submit">Save Chapter</button>
</form>