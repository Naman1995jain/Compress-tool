# Image Compression Tool Documentation

## Overview

This tool allows users to upload and compress images through a web interface. The application is built using PHP for server-side logic, JavaScript for client-side interactions, and CSS for styling.

## File Structure

- `compress.php`: Handles the image compression logic on the server-side.
- `index.php`: The main entry point of the application, providing the HTML structure and linking to CSS and JavaScript files.
- `README.md`: Provides an overview of the project and setup instructions.
- `scripts.js`: Contains JavaScript functions for handling file uploads, drag-and-drop functionality, and image previews.
- `styles.css`: Contains CSS styles for the application's user interface.

## index.php

The `index.php` file is the main entry point of the application. It includes the HTML structure and references the JavaScript and CSS files.

```index.php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Compressor</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <h1>Image Compressor</h1>
        </div>
    </header>
    <div class="description">
        <h1>Upload and Compress Your Images</h1>
        <p>Select an image to compress and download.</p>
    </div>
    <div class="content">
        <div class="container">
            <h2>Upload Image</h2>
            <div id="drop-area" class="drag-and-drop">
                <p>Drag & Drop your image here</p>
                <input type="file" id="file-upload" accept="image/*">
            </div>
            <div id="preview"></div>
            <div id="image-size"></div>
            <button class="submit-button" onclick="compressImage()">Compress Image</button>
        </div>
    </div>
    <script src="scripts.js"></script>
</body>
</html>
```
## compress.php
The compress.php file handles the image compression logic on the server-side.

## Code Explanation
- File Handling: The script checks if a file is uploaded and handles it by moving the uploaded file to the designated directory.
Response: The script returns a JSON response indicating the success or failure of the upload process.
```compress.php
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];
        
        $uploadFileDir = './uploads/';
        $dest_path = $uploadFileDir . $fileName;

        if(move_uploaded_file($fileTmpPath, $dest_path)) {
            echo json_encode([
                'message' => 'File is successfully uploaded.',
                'filePath' => $dest_path,
                'fileSize' => $fileSize,
                'fileType' => $fileType
            ]);
        } else {
            echo json_encode([
                'message' => 'There was an error moving the uploaded file.'
            ]);
        }
    } else {
        echo json_encode([
            'message' => 'No file uploaded or there was an upload error.'
        ]);
    }
} else {
    echo json_encode([
        'message' => 'Invalid request method.'
    ]);
}
?>
```
### scripts.js
The scripts.js file contains the JavaScript for handling file uploads, previews, and displaying the file size.

### Code Explanation
- Event Listeners: Event listeners are set up for drag-and-drop functionality and file input changes.
- File Handling: Functions handle file previews and display the file size after a file is selected or dropped.
- FileReader API: The FileReader API is used to read the contents of the selected file and display it as an image.

```script.js
document.addEventListener('DOMContentLoaded', (event) => {
    const dropArea = document.getElementById('drop-area');
    const fileInput = document.getElementById('file-upload');
    const preview = document.getElementById('preview');
    const imageSize = document.getElementById('image-size');

    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    // Highlight drop area when item is dragged over it
    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, unhighlight, false);
    });

    // Handle dropped files
    dropArea.addEventListener('drop', handleDrop, false);

    // Handle click to open file dialog
    dropArea.addEventListener('click', () => fileInput.click());

    // Handle file selection via file input
    fileInput.addEventListener('change', () => {
        handleFiles(fileInput.files);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    function highlight(e) {
        dropArea.classList.add('highlight');
    }

    function unhighlight(e) {
        dropArea.classList.remove('highlight');
    }

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;

        handleFiles(files);
    }

    function handleFiles(files) {
        preview.innerHTML = '';
        imageSize.innerHTML = '';
        [...files].forEach(file => {
            previewFile(file);
            displayFileSize(file);
            fileInput.files = files; // Trigger the file input change event
        });
    }

    function previewFile(file) {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onloadend = () => {
            const img = document.createElement('img');
            img.src = reader.result;
            preview.appendChild(img);
        };
    }

    function displayFileSize(file) {
        const sizeInKB = (file.size / 1024).toFixed(2);
        imageSize.innerHTML = `File Size: ${sizeInKB} KB`;
    }
});
```
### styles.css
The styles.css file contains the styling for the application.

### Code Explanation
- Body Styles: Sets the overall font, background gradient, and layout of the application.
- Header and Logo: Styles for the header and logo.
- Description and Content: Styles for the description and content sections.
- Drag-and-Drop Area: Styles for the drag-and-drop file upload area, including hover effects.
- Preview and File Size: Styles for the image preview and file size display.
- Buttons: Styles for the submit and download buttons.
- Responsive Design: Media queries for responsive design, ensuring the application looks good on different screen sizes.

```styles.css
body {
    font-family: 'Arial', sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    min-height: 100vh;
    background: linear-gradient(114deg, #e9f58f, #5d05a8, #50bbed, #5ad382, #9bd5c4);
    background-size: 300% 300%;
    animation: gradient-animation 50s ease infinite;
}

@keyframes gradient-animation {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

header {
    width: 100%;
    background-color: #343a40;
    color: white;
    padding: 10px 0;
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.logo {
    display: flex;
    align-items: center;
}

.logo h1 {
    margin: 0;
    font-size: 24px;
    margin-left: 10px;
    font-family: 'Exo', sans-serif;
}

.description {
    text-align: center;
    margin: 20px 0;
    padding: 0 20px;
    animation: fadeIn 2s ease-in-out;
}

@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

.description h1 {
    font-size: 32px;
    color: #fff;
}

.description p {
    font-size: 18px;
    color: #fff;
    line-height: 1.6;
    max-width: 600px;
    margin: 10px auto 0;
}

.content {
    display: flex;
    align-items: flex-start;
    justify-content: center;
    width: 100%;
    max-width: 1200px;
    padding: 20px;
    flex-wrap: wrap;
    animation: slideUp 2s ease-in-out;
}

@keyframes slideUp {
    0% {
        transform: translateY(50px);
        opacity: 0;
    }
    100% {
        transform: translateY(0);
        opacity: 1;
    }
}

.container {
    background-color: #ffffff;
    padding: 90px;
    border-radius: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    max-width: 600px;
    width: 100%;
    margin-right: 20px;
    margin-bottom: 20px;
    flex: 1;
}

h2 {
    color: #343a40;
}

.drag-and-drop {
    border: 2px dashed #007bff;
    border-radius: 10px;
    padding: 50px;
    background-color: #f1f1f1;
    color: #007bff;
    cursor: pointer;
    transition: background-color 0.3s ease, border-color 0.3s ease;
    position: relative;
    text-align: center;
}

.drag-and-drop:hover {
    background-color: #e9ecef;
    border-color: #0056b3;
}

.drag-and-drop p {
    margin: 0;
    font-size: 18px;
}

#file-upload {
    display: none;
}

#preview img {
    max-width: 100%;
    max-height: 200px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-top: 10px;
    animation: fadeIn 0.5s ease-in-out;
}

#image-size {
    margin-top: 10px;
    font-size: 16px;
    color: #333;
}

.size-info {
    margin-top: 10px;
    font-size: 16px;
    color: #333;
}

.submit-button {
    background-color: #28a745;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 10px;
    transition: background-color 0.3s ease;
}

.submit-button:hover {
    background-color: #218838;
}

.fixed-box {
    background-color: #ffffff;
    padding: 65px;
    border-radius: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 300px;
    height: 350px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    margin-bottom: 20px;
}

.output img {
    max-width: 100%;
    max-height: 200px;
    border: 1px solid #ddd;
    border-radius: 5px;
    animation: fadeIn 0.5s ease-in-out;
}

.output a {
    display: block;
    margin-top: 10px;
    color: #ffffff;
    text-decoration: none;
}

.output a:hover {
    color: white;
}

.download-button {
    background-color: #28a745;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    margin-top: 10px;
    transition: background-color 0.3s ease;
}

.download-button:hover {
    background-color: #218838;
}

.compressed-title {
    font-size: 24px;
    color: #343a40;
    margin-bottom: 20px;
}

.image-type {
    margin-top: 10px;
    font-size: 18px;
    color: #333;
}

.format-buttons {
    display: flex;
    justify-content: center;
    margin-top: 10px;
}

.format-buttons label {
    background-color: green;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin: 0 5px;
    display: inline-block;
    transition: background-color 0.3s ease;
}

.format-buttons input[type="radio"] {
    display: none;
}

.format-buttons input[type="radio"]:checked+label {
    background-color: #0056b3;
}

.image-type-display {
    margin-top: 10px;
    font-size: 16px;
    color: #333;
}

/* Media Queries for Responsive Design */

@media (max-width: 768px) {
    .content {
        flex-direction: column;
        align-items: center;
    }
    .container,
    .fixed-box {
        margin-right: 0;
        width: 100%;
        padding: 20px;
    }
    .container {
        margin-bottom: 20px;
    }
    .fixed-box {
        height: auto;
    }
}

@media (max-width: 480px) {
    .description h1 {
        font-size: 24px;
    }
    .description p {
        font-size: 16px;
    }
    .container,
    .fixed-box {
        padding: 15px;
    }
    .file-upload label,
    .submit-button,
    .format-buttons label {
        padding: 8px 15px;
    }
    .download-button {
        padding: 8px 15px;
    }
}
```
