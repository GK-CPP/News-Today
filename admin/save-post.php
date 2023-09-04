<?php
include "config.php";

session_start();

// try {

//     /*********find any error here******** */
//     if (isset($_FILES['fileToUpload'])) {
//         $errors = array();
//         $file_name = $_FILES['fileToUpload']['name'];
//         $file_size = $_FILES['fileToUpload']['size'];
//         $file_tmp = $_FILES['fileToUpload']['tmp_name'];
//         $file_type = $_FILES['fileToUpload']['type'];
//         $file_ext = strtolower(end(explode('.', $_FILES['fileToUpload']['name'])));

//         $expensions = array("jpeg", "jpg", "png");

//         if (in_array($file_ext, $expensions) === false) {
//             $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
//         }

//         if (empty($errors) == true) {
//             move_uploaded_file($file_tmp, "uploads/" . $file_name);
//         } else {
//             print_r($errors);
//             die();
//         }
//     }
// } catch (Exception $e) {
//     echo $e->getMessage();
//     die();
// }

$title = mysqli_real_escape_string($conn, $_POST['post_title']);
$description = mysqli_real_escape_string($conn, $_POST['postdesc']);
$category = mysqli_real_escape_string($conn, $_POST['category']);
$date = date("d M, Y");
$author = $_SESSION['id'];

$sql = "INSERT INTO post (title, description, category, post_date, author) VALUES ('{$title}', '{$description}', '{$category}', '{$date}', '{$author}');";
$sql .= "update catalog set post = post + 1 where category_id = {$category}";
if ($conn->multi_query($sql) === TRUE) {
    header("Location: {$hostname}/admin/post.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
