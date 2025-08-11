<?php
header('Content-Type: application/json');

// Database configuration
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "fileuploads"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

// Get form data
$title = isset($_POST['comment_title']) ? trim($_POST['comment_title']) : '';
$comment = isset($_POST['comment_text']) ? trim($_POST['comment_text']) : '';

// Validate inputs
if (empty($title)) {
    echo json_encode(['success' => false, 'message' => 'Comment title is required']);
    exit();
}

if (empty($comment)) {
    echo json_encode(['success' => false, 'message' => 'Comment text is required']);
    exit();
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO comments (title, comment, created_at) VALUES (?, ?, NOW())");
if ($stmt === false) {
    echo json_encode(['success' => false, 'message' => 'Database prepare statement failed']);
    exit();
}

$stmt->bind_param("ss", $title, $comment);

// Execute the statement
if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Comment posted successfully!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error posting comment: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>