<?php
// Function to generate a random short code
function generateShortCode($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $shortcode = '';
    for ($i = 0; $i < $length; $i++) {
        $shortcode .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $shortcode;
}

// Check if the form was submitted
if (isset($_POST['url'])) {
    $url = $_POST['url'];

    // Check if the URL is valid
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        // Generate a unique short code
        $shortcode = generateShortCode();

        // Save the URL and short code in a database or file
        // For simplicity, we'll use a file in this example
        $data = $url . ' ' . $shortcode . PHP_EOL;
        file_put_contents('urls.txt', $data, FILE_APPEND);

        // Display the short URL
        $shortUrl = 'https://yourdomain.com/' . $shortcode;
        echo 'Short URL: <a href="' . $shortUrl . '">' . $shortUrl . '</a>';
    } else {
        echo 'Invalid URL. Please enter a valid URL.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>URL Shortener</title>
</head>
<body>
    <h1>URL Shortener</h1>
    <form method="post">
        <label for="url">Enter URL:</label>
        <input type="text" name="url" id="url" required>
        <input type="submit" value="Shorten">
    </form>
</body>
</html>
