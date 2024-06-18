## Screenshot
![image](https://github.com/Naman1995jain/Compress-tool/assets/131385927/0a7993e5-83b0-468a-82a2-8f05c7f571e6)
![image](https://github.com/Naman1995jain/Compress-tool/assets/131385927/aeb97131-5cf4-4b56-b5e9-1a71529bf1d8)



# Image Compressor

This project is a web-based image compression tool similar to compressimage.io. It allows users to upload images, compress them, and download the compressed versions.

## Features

- Upload images in various formats (JPG, JPEG, PNG, GIF).
- Compress uploaded images to reduce file size.
- Download compressed images.
- Responsive design with a clean and intuitive user interface.

## Technologies Used

- HTML
- CSS
- PHP

## Files

- `index.html`: The main HTML file containing the structure of the web page.
- `styles.css`: The CSS file for styling the web page.
- `compress.php`: The PHP file handling image upload and compression.
- `com.php`: Additional PHP file (functionality to be determined based on its content).

## Setup and Installation

1. **Clone the repository**

   ```bash
   git clone https://github.com/your-username/image-compressor.git
   cd image-compressor
2. **Move files to your server's root directory

Ensure you have a server (like Apache or Nginx) running with PHP support. Move the index.html, styles.css, compress.php, and com.php files to your server's root directory or the appropriate folder.

3. **Run the server

Start your server if it’s not already running. For example, if you are using XAMPP, start Apache and navigate to the project folder in your browser.

## Usage

- Open the web page in your browser.

- Use the file upload section to choose an image from your device.

- Click the "Upload Image" button to compress the image.

- Once the image is compressed, it will be displayed on the page with a download link.
  

## File Structure

/image-compressor
│
├── index.html          # Main HTML structure
├── styles.css          # CSS styles for the web page
├── compress.php        # Handles file upload and compression
└── uploads/            # Directory where uploaded images are stored
