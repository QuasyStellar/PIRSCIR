<?php
require_once 'vendor/autoload.php';
require_once 'personalization.php';

use Amenadiel\JpGraph\Graph\Graph;
use Amenadiel\JpGraph\Graph\PieGraph;
use Amenadiel\JpGraph\Plot\PiePlot;
use Amenadiel\JpGraph\Plot\LinePlot;
use Amenadiel\JpGraph\Plot\BarPlot;

$mysqli = new \mysqli("db", "user", "password", "restaurant_db");
$type = $_GET['type'] ?? 'pie';

function addWatermark($graph, $language) {
    $imgData = $graph->Stroke(_IMG_HANDLER);
    // Цвет серый с прозрачностью
    $color = imagecolorallocatealpha($imgData, 128, 128, 128, 70);
    $font = '/app/vendor/amenadiel/jpgraph/src/fonts/DejaVuSans.ttf';
    $text = ($language == 'ru' ? "РЕСТОРАН" : "RESTAURANT");
    
    if (file_exists($font)) {
        // Используем TTF для корректного отображения кириллицы
        imagettftext($imgData, 15, 0, 10, 290, $color, $font, $text);
    } else {
        // Откат, если шрифт не найден
        imagestring($imgData, 5, 250, 270, $text, $color);
    }
    
    header("Content-Type: image/png");
    imagepng($imgData);
    imagedestroy($imgData);
}

if ($type == 'pie') {
    $data = $mysqli->query("SELECT rating, COUNT(*) as count FROM statistics GROUP BY rating")->fetch_all(MYSQLI_NUM);
    $values = array_column($data, 1);
    $labels = array_map(fn($v) => ($language == 'ru' ? "Рейтинг " : "Rating ") . $v[0], $data);
    
    $graph = new PieGraph(400, 300);
    $graph->title->Set($language == 'ru' ? "Распределение рейтинга" : "Rating Distribution");
    $p1 = new PiePlot($values);
    $p1->SetLabels($labels);
    $graph->Add($p1);
    addWatermark($graph, $language);

} elseif ($type == 'line') {
    $data = $mysqli->query("SELECT price FROM statistics LIMIT 20")->fetch_all(MYSQLI_NUM);
    $datay = array_column($data, 0);
    
    $graph = new Graph(400, 300);
    $graph->SetScale("textlin");
    $graph->title->Set($language == 'ru' ? "Динамика цен" : "Price Dynamics");
    $lineplot = new LinePlot($datay);
    $graph->Add($lineplot);
    addWatermark($graph, $language);

} elseif ($type == 'bar') {
    $data = $mysqli->query("SELECT category_id, COUNT(*) as count FROM statistics GROUP BY category_id")->fetch_all(MYSQLI_NUM);
    $values = array_column($data, 1);
    
    $graph = new Graph(400, 300);
    $graph->SetScale("textlin");
    $graph->title->Set($language == 'ru' ? "Блюда по категориям" : "Dishes by Categories");
    $barplot = new BarPlot($values);
    $graph->Add($barplot);
    addWatermark($graph, $language);
}
