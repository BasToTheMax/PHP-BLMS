<?php
    if ( !defined("LOAD") ) die("Direct access now allowed!");

    include_once("./config.php");

    if ( !isset($CONF) ) {
        die("Configuration file not found.");
    }

    try {

        $db = new PDO(
            "mysql:host=".$CONF['db.host'].";dbname=".$CONF['db.database'],
        $CONF['db.user'],
        $CONF['db.password']
        );

    } catch ( PDOException $e ) {
        echo "Connection failed: ". $e->getMessage();
        die();
    }

    function get_setting($key) {
        global $db;
        $query = $db->prepare("SELECT `confValue` FROM `settings` WHERE `confName` = ?;");
        $query->execute([ $key ]);
        $result = $query->fetch();

        return $result['confValue'];
    }

    function db_query($query, $params = [], $single = false) {
        global $db;
        $query = $db->prepare($query);
        $query->execute($params);
        if ($single == false) {
            $result = $query->fetchAll();
        } else {
            $result = $query->fetch();
        }
        return $result;
    }