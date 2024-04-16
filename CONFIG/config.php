<?php

/**
 * Configuration settings for this web application
 * These are defined as global constants which will be available in ALL SCRIPTS, CLASSES and FUNCTIONS
 */


 
define('__CSS', 'css/my-style.css'); // reference to CSS
define('__DEBUG', 0); // constants are defined using the define keyword 1=true, 0=false
define('__LOGIN_ATTEMPT_MAX', 3); // limit the number of login attempts
define('__USER_ERROR_PAGE', 'error.php'); // script to redirect to in case of error

/**
 * Transform a configuration array to a String for writing to a file
 */
function configToString($config): string
{
    $text = '';
    foreach ($config as $key => $value)
        $text .= $key . ' = "' . $value . '"' . "\n";

    return $text;
}
/**
 * Create a configuration file if it does not exist with default values
 * @param string $config_file_path The path to the configuration file. Default is 'config.ini'
 * @return array The configuration data
 */
function createConfigFileIfNotExists($config_file_path = 'config.ini'): array
{
    if (!file_exists($config_file_path)) {

        $default_config = [
            'database.params.host' => 'localhost',
            'database.params.username' => 'root',
            'database.params.password' => '',
            'database.params.dbname' => 'it-school-v2024',
        ];

        // Write the config text content to the file
        file_put_contents($config_file_path, configToString($default_config));
    }

    return parse_ini_file($config_file_path);
}
