<?php

function handleImageUpload()
{
    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        return ['message' => 'Error uploading the image.'];
    }

    $imageType = getImageMimeType($_FILES['image']['tmp_name']);
    if (!$imageType) {
        return ['message' => 'Invalid image type. Please upload a JPEG, PNG, or WEBP image.'];
    }

    $outputFormat = $_POST['format'] ?? 'jpg';

    $outputImagePath = compressImageFile($_FILES['image']['tmp_name'], $imageType, $outputFormat);
    if (!$outputImagePath) {
        return ['message' => 'Error compressing the image.'];
    }

    return ['message' => 'Image uploaded successfully.', 'imageType' => $imageType, 'output_image' => $outputImagePath];
}

function getImageMimeType($imagePath)
{
    $imageInfo = getimagesize($imagePath);
    return $imageInfo ? $imageInfo['mime'] : false;
}

function compressImageFile($imagePath, $imageMimeType, $outputFormat)
{
    // Create an image resource from the uploaded file
    $imageResource = createImageResource($imagePath, $imageMimeType);
    if (!$imageResource) {
        return false;
    }

    $outputFileName = 'compressed_' . time() . '.' . $outputFormat;

    saveCompressedImage($imageResource, $outputFormat, $outputFileName);

    imagedestroy($imageResource);

    return $outputFileName;
}

function createImageResource($imagePath, $imageMimeType)
{
    return match ($imageMimeType) {
        'image/jpeg' => imagecreatefromjpeg($imagePath),
        'image/png' => imagecreatefrompng($imagePath),
        'image/webp' => imagecreatefromwebp($imagePath),
        default => false,
    };
}

function saveCompressedImage($imageResource, $outputFormat, $outputFileName)
{
    return match ($outputFormat) {
        'jpg' => imagejpeg($imageResource, $outputFileName, 40),
        'png' => imagepng($imageResource, $outputFileName, 8),
        'webp' => imagewebp($imageResource, $outputFileName, 40),
        default => false,
    };
}
