<?php
    define("LOAD", true);

    if ($_SERVER['REQUEST_METHOD'] != 'GET') {
        http_response_code(405);
        die("Method not allowed. Please use GET");        
    }

    // Import db
    require_once("./db.php");

    // Show landing page
    include_once("./handlers/landing.php");