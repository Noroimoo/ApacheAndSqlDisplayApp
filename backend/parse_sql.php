<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aero";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$dirPath = 'sql/';

// Чтение всех SQL-файлов в папке /sql
$sqlFiles = glob($dirPath . '*.sql');

// Обработка каждого SQL-файла
foreach ($sqlFiles as $sqlFile) {
    // Получение имени таблицы из  файла
    $tableName = basename($sqlFile, '.sql');
    // Проверяем, существует ли таблица в ДБ
    $result = $conn->query("SHOW TABLES LIKE '$tableName';");
    if ($result->num_rows > 0) {
        echo "Table $tableName exists.\n";
    } else {
        // Если таблицы не существует в дб, то мы импортируем ее из SQL-файла
        $query = file_get_contents($sqlFile);
        if ($conn->multi_query($query)) {
            // Извлечение всех строк
            do {
                if ($result = $conn->store_result()) {
                    $result->free();
                }
            } while ($conn->more_results() && $conn->next_result());
			
			//echo тут осталось для дебага. Лучше держать закоменченым.
            //echo "SQL file $sqlFile has been imported successfully.\n";
        } else {
            //echo "Error importing SQL file $sqlFile: " . $conn->error . "\n";
        }
    }

    // Чтение SQL-файла
    $sqlFileContent = file_get_contents($sqlFile);
    $queriesArray = explode(';', $sqlFileContent);

    // Обновляем таблицу
    foreach ($queriesArray as $query) {
        // Удаление комментариев, лишних пробелов и начало с запроса INSERT
        $fixedQuery = trim(preg_replace('/(--(.*))/i', '', $query));
        if (substr($fixedQuery, 0, 6) === "INSERT") {
            // Замена INSERT INTO на REPLACE INTO
            $updateQuery = preg_replace('/INSERT INTO/i', 'REPLACE INTO', $fixedQuery);

            // Извлечение всех результатов и их очистка
            if ($conn->query($updateQuery) === TRUE) {
                //echo "Table $tableName has been updated with newer entries.\n";
        
                do {
                    if ($result = $conn->store_result()) {
                        $result->free();
                    }
                } while ($conn->more_results() && $conn->next_result());
            } else {
                 //echo "Error updating table: " . $conn->error . "\n";
            }
        }
    }
}

?>

