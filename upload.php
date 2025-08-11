<?php
$host = "localhost";
$user = "root"; // change to your DB user
$pass = ""; // change to your DB password
$dbname = "fileuploads"; // change to your DB name

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}

if (!empty($_FILES['file'])) {
    $fileName = $_FILES['file']['name'];
    $fileType = $_FILES['file']['type'];
    $fileSize = $_FILES['file']['size'];
    $uploadDate = date("Y-m-d H:i:s");

    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) mkdir($uploadDir);

    $filePath = $uploadDir . basename($fileName);
    if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
        $stmt = $conn->prepare("INSERT INTO files (name, type, size, path, upload_date) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiss", $fileName, $fileType, $fileSize, $filePath, $uploadDate);
        $stmt->execute();
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "File upload failed"]);
    }
}
