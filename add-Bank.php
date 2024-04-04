<?php

session_start();


if (!isset($_SESSION['username'])) {

    header("location: login.php");
    exit;
}
?>


<?php
include 'dbinfo.php';


$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_Bank'])) {

    $title = sanitize_input($_POST['Bank_title']);
    $content = sanitize_input($_POST['Bank_content']);
    $image_url = isset($_POST['Bank_image_url']) ? sanitize_input($_POST['Bank_image_url']) : ''; // Image URL is optional


    $sql = "INSERT INTO Banks (title, content, image_url) VALUES ('$title', '$content', '$image_url')";

    if ($conn->query($sql) === TRUE) {
        echo "Bank statement added successfully";
    
        header("Location: admin-index.php");
        exit();
    } else {
        echo "Error adding Bank: " . $conn->error;
    }
}

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$conn->close();
?>