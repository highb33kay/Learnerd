<!-- edit profile page -->
<?php

include '../templates/header.php';
include '../config/conn.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$msg = "";

// Get the current user's ID
$user_id = $_SESSION['user_id'];

// Check if the user has already uploaded a profile picture
$sql = "SELECT filename FROM usermeta WHERE user_id = '$user_id'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
$old_filename = $row['filename'];

// If upload button is clicked ...
if (isset($_POST['upload'])) {

    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = '../assets/uploads/';
    if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
    }

    // Validate the uploaded file
    $valid_types = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
    $image_info = getimagesize($tempname);
    if (!in_array($image_info[2], $valid_types)) {
        $msg = "Invalid file type. Only GIF, JPEG, and PNG images are allowed.";
    } else {

        $firstname = mysqli_real_escape_string($link, $_POST['first_name']);
        $lastname = mysqli_real_escape_string($link, $_POST['last_name']);
        $age = mysqli_real_escape_string($link, $_POST['age']);
        $bio = mysqli_real_escape_string($link, $_POST['bio']);
        $filename = mysqli_real_escape_string($link, $_FILES["uploadfile"]["name"]);

        // Validate the age input
        $options = array(
            'options' => array(
                'min_range' => 1,
                'max_range' => 120
            )
        );
        if (!filter_var($age, FILTER_VALIDATE_INT, $options)) {
            $msg = "Invalid age. Please enter a number between 1 and 120.";
        } else {

            // Get all the submitted data from the form
            $sql = "UPDATE usermeta SET filename = '$filename', first_name = '$firstname', last_name = '$lastname', age = '$age', bio = '$bio' WHERE user_id = '$user_id'";
            if (mysqli_query($link, $sql)) {
                $msg = "Profile updated successfully!";
            } else {
                $msg = "Failed to update profile!";
            }

            // Remove the old profile picture
            if ($old_filename != "" && $filename != $old_filename) {
                $old_file = $folder . $old_filename;
                if (file_exists($old_file)) {
                    unlink($old_file);
                }
            }

            // Now let's move the uploaded image into the folder: image
            $target_file = $folder . $filename;
            if (move_uploaded_file($tempname, $target_file)) {
                $msg = "Profile updated successfully!";
            } else {
                $msg = "Failed to update profile!";
            }
        }
    }
}


// Get the user data from the database
$sql = "SELECT * FROM usermeta WHERE user_id = '$user_id'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
$profile_pic = $row['filename'];
$firstname = $row['first_name'];
$lastname = $row['last_name'];
$age = $row['age'];
$bio = $row['bio'];

// If the user has not uploaded a profile picture, use the default image
if ($profile_pic == "") {
    $profile_pic = "../assets/images/default.png";
} else {
    $profile_pic = "../assets/uploads/" . $profile_pic;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="
anonymous">
    <link rel="stylesheet" href="../assets/css/dash.css">
</head>

<body>
    <div id="content">
        <div class="profile" id="bio">
            <!-- profile view -->

            <h1>My Profile</h1>
            <img id="profile-pic" src="<?php echo $profile_pic; ?>" alt="Profile picture">
            <div id="bio">
                <h2>Name: <?php echo $firstname . ' ' . $lastname; ?></h2>
                <p>Age: <?php echo $age; ?></p>
                <p>Bio: <?php echo $bio; ?></p>
            </div>
            <?php echo $msg; ?>

            <!-- profile edit -->
            <div class="bio">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="uploadfile">Select Image:</label>
                        <input class="form-control" type="file" name="uploadfile" value="" />
                    </div>
                    <div class="form-group">
                        <label for="first_name">First Name:</label>
                        <input class="form-control" type="text" name="first_name" value="" />
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name:</label>
                        <input class="form-control" type="text" name="last_name" value="" />
                    </div>
                    <div class="form-group">
                        <label for="age">Age:</label>
                        <input class="form-control" type="number" name="age" value="" />
                    </div>
                    <div class="form-group">
                        <label for="bio">Bio:</label>
                        <textarea class="form-control" name="bio"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" name="upload">UPLOAD</button>
                    </div>
                </form>
            </div>

        </div>
</body>

</html>