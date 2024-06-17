<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Compressor</title>
    <style>
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
        }

        .container {
            background-color: #ffffff;
            padding: 90px;
            border-radius: 80px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 600px;
            width: 100%;
            margin-right: 20px;
        }

        h2 {
            color: #343a40;
        }

        .file-upload {
            display: inline-block;
            margin-bottom: 20px;
        }

        .file-upload input[type="file"] {
            display: none;
        }

        .file-upload label {
            display: block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            margin: 0 auto;
        }

        .file-upload label:hover {
            background-color: #0056b3;
        }

        .file-upload-text {
            margin-top: 10px;
            font-size: 14px;
            color: #666;
        }

        .file-upload-text2 {
            margin-top: 20px;
            font-size: 20px;
            color: black;
        }

        .submit-button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .submit-button:hover {
            background-color: #218838;
        }

        .fixed-box {
            background-color: #ffffff;
            padding: 65px;
            border-radius: 80px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
            height: 350px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .output img {
            max-width: 100%;
            max-height: 200px;
            border: 1px solid #ddd;
            border-radius: 5px;
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
    </style>
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
            Our Compress Tool helps you reduce the file size of your images quickly and easily.
            Simply upload your image, and our tool will compress it while maintaining the best possible quality.
            This is perfect for optimizing images for websites, email attachments, or saving space on your device.
        </p>
    </div>
    <div class="content">
        <div class="container">
            <h2>Compress Your Image</h2>
            <form method="post" enctype="multipart/form-data">
                <div class="file-upload">
                    <input id="file-upload" type="file" name="image" required />
                    <label for="file-upload">Choose Image</label>
                    <div class="file-upload-text">Please upload a JPEG, PNG, or WEBP image.</div>
                    <div class="file-upload-text2">Please Select The Type For Compress Your Img</div>
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
                    $imageType = '';
                    if (isset($_POST['submit']) && isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                        $info = getimagesize($_FILES['image']['tmp_name']);
                        if ($info) {
                            $imageType = $info['mime'];
                            echo "Uploaded Image Type: " . strtoupper($imageType);
                        }
                    }
                    ?>
                </div>
                <div class="image-type-display">
                    <?php
                    if ($imageType) {
                        echo "You have uploaded a " . strtoupper(explode('/', $imageType)[1]) . " image.";
                    }
                    ?>
                </div>
            </form>
        </div>
        <div class="fixed-box">
            <div class="compressed-title">Compressed Image</div>
            <div class="output">
                <?php
                if (isset($_POST['submit']) && isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                    $format = $_POST['format'];
                    $output_image = 'compressed_' . time() . '.' . $format;

                    $img = null;
                    if ($imageType == "image/jpeg") {
                        $img = imagecreatefromjpeg($_FILES['image']['tmp_name']);
                    } elseif ($imageType == "image/png") {
                        $img = imagecreatefrompng($_FILES['image']['tmp_name']);
                    } elseif ($imageType == "image/webp") {
                        $img = imagecreatefromwebp($_FILES['image']['tmp_name']);
                    }

                    if ($img) {
                        if ($format == "jpg") {
                            imagejpeg($img, $output_image, 40);
                        } elseif ($format == "png") {
                            imagepng($img, $output_image, 8);
                        } elseif ($format == "webp") {
                            imagewebp($img, $output_image, 40);
                        }
                        imagedestroy($img);
                        echo "<img src='$output_image' alt='Compressed Image'/>";
                        echo "<a href='$output_image' download class='download-button'>Download Compressed Image</a>";
                    } else {
                        echo "Please select a JPEG, PNG, or WEBP image.";
                    }
                }
                ?>
            </div>
        </div>
    </div>
    </div>
</body>

</html>