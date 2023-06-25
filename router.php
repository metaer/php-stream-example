<?php
// File: router.php

$requestUri = $_SERVER['REQUEST_URI'];

if ($requestUri === '/stream') {
    // Disable output buffering
    @ini_set('zlib.output_compression', 0);
    @ini_set('implicit_flush', 1);
    for ($i = 0; $i < ob_get_level(); $i++) {
        ob_end_flush();
    }
    ob_implicit_flush(1);

    // CORS headers for cross-origin requests
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header('Access-Control-Allow-Headers: Content-Type');

    // Set content type to text/plain
    header('Content-Type: text/plain');

    // Send initial part of the response
    echo "Starting stream...\n";
    flush();

    // Simulate delayed stream of data
    for ($i = 1; $i <= 5; $i++) {
        sleep(1); // sleep for 1 second
        echo "This is chunk number $i\n";
        flush(); // flush the output buffer
    }

    echo "Stream complete.";

} else {
    // Handle other routes or return 404
    header('HTTP/1.1 404 Not Found');
    echo '404 Not Found';
}