<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aero";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Создание таблицы apache_logs, если она не существует
$createTableQuery = "CREATE TABLE IF NOT EXISTS apache_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ip VARCHAR(255) NOT NULL,
    datetime VARCHAR(255) NOT NULL,
    request_method VARCHAR(10) NOT NULL,
    url VARCHAR(2083) NOT NULL,
    protocol VARCHAR(10) NOT NULL,
    status_code INT NOT NULL,
    response_size INT NOT NULL,
    referrer VARCHAR(2083),
    user_agent VARCHAR(255)
)";

if (!$conn->query($createTableQuery)) {
    die("Error creating table: " . $conn->error);
}

// Чтение всех файлов из папки 'apache'
$dir = 'apache';
$files = array_diff(scandir($dir), array('.', '..'));

// Обработка каждого файла
foreach ($files as $file) {
    $full_path = $dir . '/' . $file;

    // Открытие файла
    $handle = fopen($full_path, 'r');

    if ($handle) {
        // Regex для разбивания строк
        $regex = '/^(\S+)\s\S+\s\S+\s\[([\w:\/\s+]+)\]\s"(\S+)\s(\S+)\s(\S+)"\s(\d{3})\s(\d+)\s"([^"]*)"\s"([^"]*)"$/';
        $buffer_size = 100; // Сколько вствляем в лог
        $record_buffer = [];

        // Чтение каждой строки файла
        while (($line = fgets($handle)) !== false) {
            // Если строка соответствует regex, то добавляем ее в буфер
            if (preg_match($regex, $line, $matches)) {
                list($whole_match, $ip, $datetime, $method, $url, $protocol, $status, $response_size, $referrer, $user_agent) = $matches;
                $record_buffer[] = "('".$conn->real_escape_string($ip)."', '".$conn->real_escape_string($datetime)."', '".$conn->real_escape_string($method)."', '".$conn->real_escape_string($url)."', '".$conn->real_escape_string($protocol)."', ".(int)$status.", ".(int)$response_size.", '".$conn->real_escape_string($referrer)."', '".$conn->real_escape_string($user_agent)."')";

                // Если буфер достигает максимум линий, то вставляем буфер в таблицу и отчищаем буфер
                if (count($record_buffer) >= $buffer_size) {
                    $sql = "INSERT IGNORE INTO apache_logs (ip, datetime, request_method, url, protocol, status_code, response_size, referrer, user_agent) VALUES " . implode(", ", $record_buffer);
                    if (!$conn->query($sql)) {
                        echo "Error inserting Apache log entry: " . $conn->error;
                    }
                    $record_buffer = [];
                }
            }
        }

        // Проверяем остались ли линии в буфере. Если остались, то добавляем их в таблицу
        if (!empty($record_buffer)) {
            $sql = "INSERT IGNORE INTO apache_logs (ip, datetime, request_method, url, protocol, status_code, response_size, referrer, user_agent) VALUES " . implode(", ", $record_buffer);
            if (!$conn->query($sql)) {
                echo "Error inserting Apache log entry: " . $conn->error;
            }
        }

        // Закрываем файл
        fclose($handle);
    } else {
        echo "Error: Could not read the log file: $file.";
    }
}

?>
