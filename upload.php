<?php
// Set higher limits programmatically (in addition to php.ini)
ini_set('max_execution_time', 600);
ini_set('max_input_time', 600);
ini_set('memory_limit', '256M');

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "fileuploads";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}

// Allowed file types with their MIME types
$allowedTypes = [
    'image/jpeg' => 'jpg',
    'image/png' => 'png',
    'image/gif' => 'gif',
    'application/pdf' => 'pdf',
    'application/zip' => 'zip',
    'application/photoshop' => 'psd',
    'image/vnd.adobe.photoshop' => 'psd',
    'application/octet-stream' => 'psd' // Fallback for PSD
];

$response = ['status' => 'error', 'message' => 'No files uploaded'];

if (!empty($_FILES['files'])) {
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $uploadedFiles = [];
    $errors = [];

    foreach ($_FILES['files']['tmp_name'] as $key => $tmpName) {
        $fileName = $_FILES['files']['name'][$key];
        $fileType = $_FILES['files']['type'][$key];
        $fileSize = $_FILES['files']['size'][$key];
        $fileError = $_FILES['files']['error'][$key];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Validate file
        if ($fileError !== UPLOAD_ERR_OK) {
            $errors[] = "File $fileName upload error: " . $fileError;
            continue;
        }

        // Check if file type is allowed (either by MIME or extension for PSD)
        $allowed = false;
        if (isset($allowedTypes[$fileType])) {
            $allowed = true;
        } elseif ($fileExt === 'psd') {
            // Special case for PSD files that might have incorrect MIME
            $allowed = true;
            $fileType = 'image/vnd.adobe.photoshop';
        }

        if (!$allowed) {
            $errors[] = "File type not allowed for $fileName";
            continue;
        }

        // Generate unique filename to prevent overwrites
        $newFileName = uniqid() . '_' . preg_replace('/[^a-zA-Z0-9\.\-]/', '_', $fileName);
        $filePath = $uploadDir . $newFileName;

        // Move the file
        if (move_uploaded_file($tmpName, $filePath)) {
            // Store file info in database
            $uploadDate = date("Y-m-d H:i:s");
            $stmt = $conn->prepare("INSERT INTO files (name, type, size, path, upload_date) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssiss", $fileName, $fileType, $fileSize, $filePath, $uploadDate);
            
            if ($stmt->execute()) {
                $uploadedFiles[] = $fileName;
            } else {
                $errors[] = "Failed to save $fileName to database";
                // Remove the uploaded file if DB failed
                unlink($filePath);
            }
        } else {
            $errors[] = "Failed to move uploaded file $fileName";
        }
    }

    if (!empty($uploadedFiles)) {
        $response = [
            'status' => 'success',
            'message' => 'Files uploaded successfully',
            'files' => $uploadedFiles
        ];
        if (!empty($errors)) {
            $response['warnings'] = $errors;
        }
    } elseif (!empty($errors)) {
        $response['message'] = implode("\n", $errors);
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>