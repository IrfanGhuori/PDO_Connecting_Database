<?php
/**
 * Secure PDO Database Connection
 *
 * @category  PDO
 * @author    Irfan Ghuori <IrfanGhuori@yandex.com>
 * @license   MIT License
 */

// Prevent direct access to this file.
if (!defined('ACCESS_ALLOW')) {
    http_response_code(403);
    exit('Forbidden');
}

final class ConnectMe
{
    private string $dbHost;
    private string $dbName;
    private string $dbUser;
    private string $dbPass;
    private ?PDO $pdo = null;

    public function __construct()
    {
        $this->dbHost = getenv('DB_HOST') ?: 'localhost';
        $this->dbName = getenv('DB_NAME') ?: 'test';
        $this->dbUser = getenv('DB_USER') ?: 'root';
        $this->dbPass = getenv('DB_PASS') ?: '';

        $this->connect();
    }

    private function connect(): void
    {
        $dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8mb4', $this->dbHost, $this->dbName);
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_PERSISTENT => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $this->dbUser, $this->dbPass, $options);
        } catch (PDOException $exception) {
            error_log('Database connection failed: ' . $exception->getMessage());
            throw new RuntimeException('Unable to connect to the database.');
        }
    }

    public function getConnection(): PDO
    {
        if ($this->pdo === null) {
            $this->connect();
        }

        return $this->pdo;
    }

    public function __destruct()
    {
        $this->pdo = null;
    }
}
