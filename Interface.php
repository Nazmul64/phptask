<?php

interface LoggerInterface {
    public function log(string $message): void;
}

class FileLogger implements LoggerInterface {
    private string $filePath;
    public function __construct(string $filePath) {
        $this->filePath = $filePath;
    }
    public function log(string $message): void {
        $formattedMessage = sprintf("[%s] %s%s", date('Y-m-d H:i:s'), $message, PHP_EOL);
        file_put_contents($this->filePath, $formattedMessage, FILE_APPEND);
    }
}

class DatabaseLogger implements LoggerInterface {
    private PDO $pdo;
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }
    public function log(string $message): void {
        $stmt = $this->pdo->prepare("INSERT INTO logs (message, log_time) VALUES (:message, :log_time)");
        $stmt->execute([
            'message' => $message,
            'log_time' => date('Y-m-d H:i:s')
        ]);
    }
}

try {
    $fileLogger = new FileLogger('app.log');
    $fileLogger->log("This is a log message to the file.");
    $dsn = 'mysql:host=localhost;dbname=testdb';
    $username = 'root';
    $password = '';
    $pdo = new PDO($dsn, $username, $password);
    $databaseLogger = new DatabaseLogger($pdo);
    $databaseLogger->log("This is a log message to the database.");
    
    echo "Logging to file and database completed successfully.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>
