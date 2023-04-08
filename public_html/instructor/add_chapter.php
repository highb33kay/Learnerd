<?php

include '../templates/header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// get course id from url
$course_id = $_GET['id'] ?? '';

if (!$course_id) {
    header('Location: index.php');
    exit;
}

// Get existing chapter numbers for this course
$query = "SELECT chapter_number FROM chapters WHERE course_id = ?";
$stmt = $link->prepare($query);
$stmt->bind_param('i', $course_id);
$stmt->execute();
$chapter_numbers = array();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $chapter_numbers[] = $row['chapter_number'];
}

// Get the next chapter number
$next_chapter_number = max($chapter_numbers) + 1;

// Get form data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_chapter'])) {
    // Get form data
    $chapter_title = $_POST['chapter_title'];
    $chapter_description = $_POST['chapter_description'];

    // Create chapter in database
    $query = "INSERT INTO chapters (course_id, chapter_number, chapter_title, chapter_description) VALUES (?, ?, ?, ?)";
    $stmt = $link->prepare($query);
    $stmt->bind_param('iiss', $course_id, $next_chapter_number, $chapter_title, $chapter_description);
    $stmt->execute();

    header('Location: add_chapter.php?id=' . $course_id);
    exit;
}

?>

<form method="post" action="">
    <?php
    echo '<label for="chapter_number">Chapter Number:</label>';
    echo '<select name="chapter_number" id="chapter_number">';
    echo '<option value="' . $next_chapter_number . '">' . $next_chapter_number . '</option>';
    echo '</select>';
    ?>
    <label for="chapter_title">Chapter Title:</label>
    <input type="text" name="chapter_title" id="chapter_title" value="">
    <label for="chapter_description">Chapter Description:</label>
    <textarea name="chapter_description" id="chapter_description" cols="30" rows="10"></textarea>
    <input type="submit" name="save_chapter" value="Add Chapter">
</form>