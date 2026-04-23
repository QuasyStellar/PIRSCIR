<?php
namespace App\Controllers;

use App\Models\Statistic;
use Amenadiel\JpGraph\Graph\Graph;
use Amenadiel\JpGraph\Graph\PieGraph;
use Amenadiel\JpGraph\Plot\PiePlot;
use Amenadiel\JpGraph\Plot\LinePlot;
use Amenadiel\JpGraph\Plot\BarPlot;

class ChartController extends BaseController {
    public function show() {
        $type = $_GET['type'] ?? 'pie';

        if ($type == 'pie') {
            $data = Statistic::getRatingDistribution();
            $values = array_column($data, 1);
            $labels = array_map(fn($v) => ($this->language == 'ru' ? "Рейтинг " : "Rating ") . $v[0], $data);
            $graph = new PieGraph(400, 300);
            $graph->title->Set($this->language == 'ru' ? "Распределение рейтинга" : "Rating Distribution");
            $p1 = new PiePlot($values);
            $p1->SetLabels($labels);
            $graph->Add($p1);
            $this->addWatermark($graph);
        } elseif ($type == 'line') {
            $data = Statistic::getPriceDynamics();
            $datay = array_column($data, 0);
            $graph = new Graph(400, 300);
            $graph->SetScale("textlin");
            $graph->title->Set($this->language == 'ru' ? "Динамика цен" : "Price Dynamics");
            $lineplot = new LinePlot($datay);
            $graph->Add($lineplot);
            $this->addWatermark($graph);
        } elseif ($type == 'bar') {
            $data = Statistic::getDishesByCategory();
            $values = array_column($data, 1);
            $graph = new Graph(400, 300);
            $graph->SetScale("textlin");
            $graph->title->Set($this->language == 'ru' ? "Блюда по категориям" : "Dishes by Categories");
            $barplot = new BarPlot($values);
            $graph->Add($barplot);
            $this->addWatermark($graph);
        }
    }

    private function addWatermark($graph) {
        $imgData = $graph->Stroke(_IMG_HANDLER);
        $color = imagecolorallocatealpha($imgData, 128, 128, 128, 70);
        $font = '/app/vendor/amenadiel/jpgraph/src/fonts/DejaVuSans.ttf';
        $text = ($this->language == 'ru' ? "РЕСТОРАН" : "RESTAURANT");
        if (file_exists($font)) {
            imagettftext($imgData, 15, 0, 10, 290, $color, $font, $text);
        } else {
            imagestring($imgData, 5, 250, 270, $text, $color);
        }
        header("Content-Type: image/png");
        imagepng($imgData);
        imagedestroy($imgData);
    }
}
