<?php
    define("LOAD", true);

    if ($_SERVER['REQUEST_METHOD'] != 'GET') {
        http_response_code(405);
        die("Method not allowed. Please use GET");        
    }

    echo("Hello " . $_SERVER['REQUEST_METHOD'] . " at ". $_SERVER['REQUEST_URI']);