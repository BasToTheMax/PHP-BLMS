<?php
    verify_params($request, array("email", "password"));

    $email = $request['params']['email'];
    $password = $request['params']['password'];

    // Check if user exists
    $res = db_query("SELECT password FROM users WHERE email = ?", [ $email ], true);

    var_dump($res);

    if (!isset($res) || $res == false) {
        respond(false, "User not found", -32603);
        die();
    }

    $dbPass = $res['password'];
    $password = md5($password);

    if ($dbPass!= $password) {
        respond(false, "Invalid password", -32603);
        die();
    }

    

    respond(true, "Successful!", $request);
?>