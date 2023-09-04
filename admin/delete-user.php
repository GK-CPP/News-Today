<?php

include "config.php";
session_start();

if ($_SESSION['role'] == '0') {
    header("Location: {$hostname}/admin/post.php");
}

$userid = $_GET['id'];

try {
    $sql = "delete from user where user_id='$userid'";
    $result = $conn->query($sql);
    header("Location: {$hostname}/admin/users.php");
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}

$conn->close();
