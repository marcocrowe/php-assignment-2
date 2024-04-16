<?php

require_once("config/config.php");

/**
 * Connect to the database with the connection details from the config file
 */
function connect($configFilePath = 'config.ini')
{
    $ini_array = createConfigFileIfNotExists($configFilePath);
    $host = $ini_array['database.params.host'];
    $username = $ini_array['database.params.username'];
    $password = $ini_array['database.params.password'];
    $db_name = $ini_array['database.params.dbname'];

    return new mysqli($host, $username, $password, $db_name);
}
