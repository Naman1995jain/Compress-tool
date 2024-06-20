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

```php
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
