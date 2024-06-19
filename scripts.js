// scripts.js

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