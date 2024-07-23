<?php
/**
 * Transform a configuration array to a String for writing to a file
 * @param array $config The configuration array
 * @return string The configuration text
 */
function configToString(array $config): string
{
    $text = '';
    foreach ($config as $key => $value)
        $text .= $key . ' = "' . $value . '"' . "\n";

    return $text;
}

/**
 * Connect to the database with the connection details from the config file
 * @param string $configFilePath The path to the configuration file. Default is 'config.ini'
 * @return mysqli The database connection
 */
function connectWithConfig(string $configFilePath = 'config.ini'): mysqli
{
    $ini_array = createConfigFileIfNotExists($configFilePath);
    $host = $ini_array['database.params.host'];
    $username = $ini_array['database.params.username'];
    $password = $ini_array['database.params.password'];
    $db_name = $ini_array['database.params.dbname'];

    return new mysqli($host, $username, $password, $db_name);
}

/**
 * Create a configuration file if it does not exist with default values
 * @param string $config_file_path The path to the configuration file. Default is 'config.ini'
 * @return array The configuration data
 */
function createConfigFileIfNotExists(string $config_file_path = 'config.ini'): array
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
