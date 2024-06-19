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
            <h1>Compress Tool</h1>
        </div>
    </header>

    <div class="description">
        <h1>Welcome to the Compress Tool</h1>
        <p>
            Our Compress Tool helps you reduce the file size of your images quickly and easily. Simply upload your image, and our tool will compress it while maintaining the best possible quality. This is perfect for optimizing images for websites, email attachments,
            or saving space on your device.
        </p>
    </div>
    <div class="content">
        <div class="container">
            <h2>Compress Your Image</h2>
            <form id="upload-form" method="post" enctype="multipart/form-data">
                <div class="drag-and-drop" id="drop-area">
                    <p>Drag & Drop your image here</p>
                    <p>or</p>
                    <p>Click to select image</p>
                    <input type="file" id="file-upload" name="image" accept="image/jpeg, image/png, image/webp" />
                    <div id="preview"></div>
                    <div id="image-size"></div>
                </div>
                <div class="format-buttons">
                    <input type="radio" id="format-jpg" name="format" value="jpg" checked>
                    <label for="format-jpg">JPG</label>
                    <input type="radio" id="format-png" name="format" value="png">
                    <label for="format-png">PNG</label>
                    <input type="radio" id="format-webp" name="format" value="webp">
                    <label for="format-webp">WEBP</label>
                </div>
                <input type="submit" class="submit-button" name="submit" value="Compress Image" />
                <div class="image-type">
                    <?php
                    require 'compress.php';
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $uploadResult = handleImageUpload();
                        echo $uploadResult['message'];
                        if (isset($uploadResult['original_size']) && isset($uploadResult['compressed_size'])) {
                            echo "<div class='size-info'>Original Size: " . $uploadResult['original_size'] . " KB</div>";
                            echo "<div class='size-info'>Compressed Size: " . $uploadResult['compressed_size'] . " KB</div>";
                        }
                    }
                    ?>
                </div>
                <div class="image-type-display">
                    <?php
                    if (isset($uploadResult['imageType'])) {
                        echo "You have uploaded a " . strtoupper(explode('/', $uploadResult['imageType'])[1]) . " image.";
                    }
                    ?>
                </div>
            </form>
        </div>
        <div class="fixed-box">
            <div class="compressed-title">Compressed Image</div>
            <div class="output">
                <?php
                if (isset($uploadResult['output_image'])) {
                    echo "<img src='" . $uploadResult['output_image'] . "' alt='Compressed Image'/>";
                    echo "<a href='" . $uploadResult['output_image'] . "' download class='download-button'>Download Compressed Image</a>";
                }
                ?>
            </div>
        </div>
    </div>
    <script src="scripts.js"></script>
</body>

</html>