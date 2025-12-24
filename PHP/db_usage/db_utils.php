<?php
require_once __DIR__ . '/db_config.php';

/**
 * Establish and return a PDO database connection
 * 
 * @param string $env The environment to use ('test' or 'prod')
 * @return PDO The PDO database connection
 */
function getDbConnection($env = 'test') {
    // prepare DSN string using values from the config file
    $dbConfig = getDbConfig($env);
    $dsn = "mysql:host={$dbConfig['host']};port={$dbConfig['port']};dbname={$dbConfig['dbname']};charset=utf8mb4";
    
    // Make database connection as PDO (PHP Data Object)
    $dbConnection = new PDO($dsn, $dbConfig['username'], $dbConfig['password'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    return $dbConnection;
}


/**
 * Log database error messages using a stored procedure
 * 
 * @param string $scriptName The name of the script where the error occurred
 * @param string $message The error message to log
 * @param string $env The environment to use ('test' or 'prod')
 * @return void
 */
function logDBError($scriptName, $message, $env = 'test') {
    try {
        $conn = getDbConnection($env);

        // Prepare and execute logging stored procedure
        $fullMessage = "[{$scriptName}]: {$message}";
        $stmt = $conn->prepare("CALL PRC_LOG_MESSAGE(:msg)");  // Adjust stored procedure name if needed
        $stmt->bindValue(':msg', $fullMessage);

        $stmt->execute();
    } catch (PDOException $e) {
        // Fails silently to avoid infinite recursion
        error_log("Logging failed: " . $e->getMessage());
    }
}
