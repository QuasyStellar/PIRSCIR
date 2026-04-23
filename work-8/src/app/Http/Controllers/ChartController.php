<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Amenadiel\JpGraph\Graph\Graph;
use Amenadiel\JpGraph\Graph\PieGraph;
use Amenadiel\JpGraph\Plot\PiePlot;
use Amenadiel\JpGraph\Plot\LinePlot;
use Amenadiel\JpGraph\Plot\BarPlot;

class ChartController extends Controller {
    public function show($type) {
        $language = session('language', 'ru');
        
        try {
            if ($type == 'pie') {
                $data = DB::select("SELECT rating, COUNT(*) as count FROM statistics GROUP BY rating");
                $values = array_map(fn($v) => (int)$v->count, $data);
                $labels = array_map(fn($v) => ($language == 'ru' ? "Рейтинг " : "Rating ") . $v->rating, $data);
                
                if (empty($values)) $values = [1];
                
                $graph = new PieGraph(400, 300);
                $graph->title->Set($language == 'ru' ? "Распределение рейтинга" : "Rating Distribution");
                $p1 = new PiePlot($values);
                if (!empty($labels)) $p1->SetLabels($labels);
                $graph->Add($p1);
                return $this->addWatermarkAndStroke($graph, $language);

            } elseif ($type == 'line') {
                $data = DB::select("SELECT price FROM statistics LIMIT 20");
                $datay = array_map(fn($v) => (float)$v->price, $data);
                if (empty($datay)) $datay = [0, 0, 0];
                
                $graph = new Graph(400, 300);
                $graph->SetScale("textlin");
                $graph->title->Set($language == 'ru' ? "Динамика цен" : "Price Dynamics");
                $lineplot = new LinePlot($datay);
                $graph->Add($lineplot);
                return $this->addWatermarkAndStroke($graph, $language);

            } elseif ($type == 'bar') {
                $data = DB::select("SELECT category_id, COUNT(*) as count FROM statistics GROUP BY category_id");
                $values = array_map(fn($v) => (int)$v->count, $data);
                if (empty($values)) $values = [0];
                
                $graph = new Graph(400, 300);
                $graph->SetScale("textlin");
                $graph->title->Set($language == 'ru' ? "Блюда по категориям" : "Dishes by Categories");
                $barplot = new BarPlot($values);
                $graph->Add($barplot);
                return $this->addWatermarkAndStroke($graph, $language);
            }
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    private function addWatermarkAndStroke($graph, $language) {
        $imgData = $graph->Stroke(_IMG_HANDLER);
        $color = imagecolorallocatealpha($imgData, 128, 128, 128, 70);
        $font = base_path('vendor/amenadiel/jpgraph/src/fonts/DejaVuSans.ttf');
        $text = ($language == 'ru' ? "РЕСТОРАН" : "RESTAURANT");
        
        if (file_exists($font)) {
            imagettftext($imgData, 15, 0, 10, 290, $color, $font, $text);
        } else {
            imagestring($imgData, 5, 250, 270, $text, $color);
        }
        
        ob_start();
        imagepng($imgData);
        $image = ob_get_clean();
        imagedestroy($imgData);

        return response($image)->header('Content-Type', 'image/png');
    }
}
