<?php

// Хедеры для cors
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json;charset=UTF-8");
set_time_limit(0);


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aero";

// Подключаемя и проверяем подключение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    http_response_code(500);
    die(json_encode(['error' => "Connection failed: " . $conn->connect_error]));
}

// При скрипте включаем parse_log и parse_sql
include('./parse_log.php');
include('./parse_sql.php');

function main() {
    global $conn;

    // Получаем параметров запроса
    $apiEndpoint = isset($_GET['api']) ? $_GET['api'] : '';
    $limit = $_GET['limit'] ?? 20;
    $page = (int)(isset($_GET['page']) ? $_GET['page'] : 1);

    // Оффсет для страниц
    $offset = ($page - 1)* $limit;

    // Обработка запросов в зависимости от подключения
    switch ($apiEndpoint) {
        case 'wp_s3cu_form_on_landing':
            // Извлечение из таблицы wp_s3cu_form_on_landing
            $result = $conn->query("SELECT *FROM wp_s3cu_form_on_landing LIMIT $offset, $limit");

            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }

            echo json_encode($data);

            break;

        case 'apache_logs':
            // Извлечение логов из apache_logs
            $result = $conn->query("SELECT* FROM apache_logs LIMIT $offset, $limit");

            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }

            echo json_encode($data);

            break;

        default:
            // Ответ в случае неверного покдлючения к АПИ
            http_response_code(400);
            echo json_encode(['error' => 'Invalid API Endpoint']);
            break;
    }

    // Закрытие подключения после завершения операций
    $conn->close();
}

main();
?>
