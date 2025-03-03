<?php
    if ( !defined("LOAD") ) die("Direct access now allowed!");

    $CONF = array();

    $CONF['db.host'] = 'localhost';
    $CONF['db.user'] = 'library';
    $CONF['db.password'] = '';
    $CONF['db.database'] = 'library';

    define('CONFIG', true);