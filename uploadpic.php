<?php

$uploadDir = __DIR__ . '/pic/';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Delete previous files
$files = glob($uploadDir . '*');
foreach ($files as $file) {
    if (is_file($file)) {
        unlink($file);
    }
}

$response = [];

if (isset($_FILES['files'])) {
    $files = $_FILES['files'];
    $fileCount = count($files['name']);

    for ($i = 0; $i < $fileCount; $i++) {
        $name = basename($files['name'][$i]);
        $tmpName = $files['tmp_name'][$i];
        $error = $files['error'][$i];
        $size = $files['size'][$i];

        if ($error !== UPLOAD_ERR_OK) {
            $response[] = "$name: Upload error.";
            continue;
        }

        $allowedExts = ['png', 'jpg', 'jpeg', 'gif', 'bmp', 'webp', 'tiff'];
        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

        if (!in_array($ext, $allowedExts)) {
            $response[] = "$name: Invalid file type.";
            continue;
        }

        if ($size > 5 * 1024 * 1024) {
            $response[] = "$name: File too large.";
            continue;
        }

        $destination = $uploadDir . $name;

        if (move_uploaded_file($tmpName, $destination)) {
            $response[] = "$name: Uploaded successfully.";
        } else {
            $response[] = "$name: Failed to save file.";
        }
    }

    $python = 'python'; // or 'py' depending on your environment
    $script = escapeshellarg(__DIR__ . '/strter.py');
    $output = [];
    $returnVar = 0;

    exec("$python $script", $output, $returnVar);

    if ($returnVar === 0) {
        $response[] = "Python script executed successfully.";
    } else {
        $response[] = "Python script failed to execute.";
        $response[] = implode("\n", $output);
    }
} else {
    $response[] = "No files received.";
}

header('Content-Type: text/plain; charset=utf-8');
echo implode("\n", $response);
##Created By vahid.zahani