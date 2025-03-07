<?php
    define("LOAD", true);

    include_once("./config.php");

    if ( !isset($CONF) ) {
        die("Configuration file not found.");
    }

    // Database connection
    include("./db.php");

    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        http_response_code(405);
        die("Method not allowed. Please use POST");
    }

    function respond($ok = true, $result, $request = null) {
        header("Content-Type: application/json");
        $res = array(
            "jsonrpc" => "2.0",
        );

        if ($ok) {
            $res["result"] = $result;
            $res["id"] = $request["id"];
        } else {
            $res["error"] = array(
                "code" => $request,
                "message" => $result
            );
        }

        echo(json_encode($res));
    }

    try {
        $request = json_decode(file_get_contents("php://input"), true);
    } catch (Exception $e) {
        http_response_code(400);
        respond(false, "JSON parse error: " . $e->getMessage(), -32700);
    }

    if (!$request ||!isset($request['jsonrpc']) || $request['jsonrpc']!= '2.0' ||!isset($request['method']) ||!isset($request['params'])) {
        http_response_code(400);
        respond(false, "Invalid request", -32600);
    }

   $method = $request['method'];

    // var_dump($method);

    if (!preg_match('/^v\d+\.[a-z0-9_]+(\.[a-z0-9_]+)*$/i', $method)) {
        return respond(false, "Invalid method format", -32601);
    }

    $methodFile = __DIR__ . "/api/" . str_replace(".", "/", $method) . ".php";

    if (!realpath($methodFile) || !str_starts_with(realpath($methodFile), __DIR__ . "/api/")) {
        return respond(false, "Method not found: " . $methodFile, -32601);
    }

    if (!file_exists($methodFile)) {
        return respond(false, "Method not found. (" . $methodFile . ")", -32601);
    }

    function verify_params($params, $required) {
        foreach ($required as $key) {
            if (!isset($params[$key])) {
                respond(false, "Invalid params. Missing " . $key, -32602);
                die();
            }
        }
    }

    // respond(true, "Method: " . $request['method'], $request);
    try {
        require_once($methodFile);
    } catch(Exception $e) {
      respond(false, "Internal server error", -32603);
    } 
