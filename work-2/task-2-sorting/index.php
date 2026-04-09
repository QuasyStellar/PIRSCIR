<?php
require_once 'sorting_algorithms.php';

$input_array_str = isset($_GET['array']) ? $_GET['array'] : '';
$sorted_array_display = "Массив не передан.";
$original_array_display = "Массив не передан.";

if (!empty($input_array_str)) {
    $original_array = parseArrayString($input_array_str);
    $original_array_display = formatArrayForDisplay($original_array);

    if (!empty($original_array)) {
        $sorted_array = quickSort($original_array);
        $sorted_array_display = formatArrayForDisplay($sorted_array);
    } else {
        $sorted_array_display = "Массив пуст.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Быстрая сортировка</title></head>
<body>
    <h1>Сортировка массива (Quick Sort)</h1>
    <p>Пример: <a href="?array=5,2,8,1,9,4">?array=5,2,8,1,9,4</a></p>
    
    <h3>Исходный массив:</h3>
    <pre><?php echo $original_array_display; ?></pre>

    <h3>Отсортированный массив:</h3>
    <pre><?php echo $sorted_array_display; ?></pre>

    <br><a href="/index.php">Назад на главную</a>
</body>
</html>
