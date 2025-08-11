<?php
require "upload.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $conn->real_escape_string($_POST['comment_title']);
    $comment = $conn->real_escape_string($_POST['comment_text']);
    $conn->query("INSERT INTO comments (title, comment) VALUES ('$title', '$comment')");
}

header("Location: index.php");
exit;
?>
