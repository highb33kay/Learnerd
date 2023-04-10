<!-- edit chapter -->
<?php
// Path: instructor\edit-chapter.php
// Compare this snippet from instructor\add_chapter.php:
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

// get all the chapters data for this course
$query = "SELECT * FROM chapters WHERE course_id = $course_id";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_assoc($result);

for ($i = 0; $i < count($row); $i++) {
    $chapter_number = $row['chapter_number'];
    $chapter_title = $row['chapter_title'];
    $chapter_description = $row['chapter_description'];
}





// Get the next chapter number
if (!empty($chapter_numbers)) {
    $next_chapter_number = max($chapter_numbers) + 1;
} else {
    $next_chapter_number = 1;
}

?>

<form method="post" action="">
    <?php
    echo '<label for="chapter_number">Chapter Number:</label>';
    echo '<select name="chapter_number" id="chapter_number">';
    // echo all the chapter numbers
    foreach ($chapter_numbers as $chapter_number) {
        echo '<option value="' . $chapter_number . '">' . $chapter_number . '</option>';
    }
    echo '</select>';
    ?>
    <label for="chapter_title">Chapter Title:</label>
    <input type="text" name="chapter_title" id="chapter_title" value="<?php echo $chapter_title ?>">
    <label for="chapter_description">Chapter Description:</label>
    <textarea name="chapter_description" id="chapter_description" cols="30" rows="10" value=""><?php echo $chapter_description ?></textarea>
    <input type="submit" name="save_chapter" value="Save Chapter">
</form>