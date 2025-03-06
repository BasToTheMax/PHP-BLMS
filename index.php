<?php
    define("LOAD", true);

    if ($_SERVER['REQUEST_METHOD'] != 'GET') {
        http_response_code(405);
        die("Method not allowed. Please use GET");        
    }

    $url = $_SERVER['REQUEST_URI'];
    $url = explode("?" . $_SERVER['QUERY_STRING'], $url);
    $url = $url[0];

    $paths = explode("/", $url);
    array_shift($paths);
    
    include_once("./handlers/" . $paths[0] . ".php");