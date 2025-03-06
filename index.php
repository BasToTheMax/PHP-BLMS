<?php
    define("LOAD", true);

    if ($_SERVER['REQUEST_METHOD'] != 'GET') {
        http_response_code(405);
        die("Method not allowed. Please use GET");        
    }

    include_once("./handlers/landing.php");