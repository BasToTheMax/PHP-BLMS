<?php
    verify_params($request, array("username", "password"));

    respond(true, "Successful!", $request);
?>