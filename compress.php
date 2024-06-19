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

    // Get original size
    $originalSize = filesize($_FILES['image']['tmp_name']) / 1024; // size in KB

    // Ensure output directory exists
    $outputDir = 'compressed_images/';
    if (!is_dir($outputDir)) {
        mkdir($outputDir, 0777, true);
    }

    $outputImagePath = compressImageFile($_FILES['image']['tmp_name'], $imageType, $outputFormat, $outputDir);
    if (!$outputImagePath) {
        return ['message' => 'Error compressing the image.'];
    }

    // Get compressed size
    $compressedSize = filesize($outputImagePath) / 1024; // size in KB

    return [
        'message' => 'Image uploaded and compressed successfully.',
        'imageType' => $imageType,
        'output_image' => $outputImagePath,
        'original_size' => number_format($originalSize, 2),
        'compressed_size' => number_format($compressedSize, 2)
    ];
}

function getImageMimeType($imagePath)
{
    $imageInfo = getimagesize($imagePath);
    return $imageInfo ? $imageInfo['mime'] : false;
}

function compressImageFile($imagePath, $imageMimeType, $outputFormat, $outputDir)
{
    // Create an image resource from the uploaded file
    $imageResource = createImageResource($imagePath, $imageMimeType);
    if (!$imageResource) {
        return false;
    }

    // Generate a unique output file name
    $outputFileName = $outputDir . 'compressed_' . uniqid() . '.' . $outputFormat;

    $compressionSuccess = saveCompressedImage($imageResource, $outputFormat, $outputFileName);
    imagedestroy($imageResource);

    return $compressionSuccess ? $outputFileName : false;
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
