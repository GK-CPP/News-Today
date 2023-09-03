<?php


$hostname = "http://localhost/News Today";

$conn = new mysqli('localhost', 'root', '', 'news_today');
if ($conn->connect_error) {
    die('Connection Failed : ' . $conn->connect_error);
}
