<?php
require_once 'helpers.php';

$num = isset($_GET['num']) ? (int)$_GET['num'] : 0;

$shapeType = $num & 3;             // Bits 0-1
$colorIdx  = ($num >> 2) & 7;      // Bits 2-4
$size      = ($num >> 5) & 127;    // Bits 5-11

$color = isset(COLORS[$colorIdx]) ? COLORS[$colorIdx] : 'black';
if ($size === 0) $size = 50;

$svg_content = "";
$title = "Рисование фигуры";

switch ($shapeType) {
    case SHAPE_RECTANGLE:
        $title = "Квадрат (Цвет: $color, Размер: $size)";
        $svg_content = drawRectangle($size, $color);
        break;
    case SHAPE_TRIANGLE:
        $title = "Треугольник (Цвет: $color, Размер: $size)";
        $svg_content = drawTriangle($size, $color);
        break;
    case SHAPE_CIRCLE:
    default:
        $title = "Круг (Цвет: $color, Размер: $size)";
        $svg_content = drawCircle($size, $color);
        break;
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title><?php echo $title; ?></title></head>
<body>
    <h1><?php echo $title; ?></h1>
    <svg width="100" height="100" style="border: 1px solid black; background: #eee;">
        <?php echo $svg_content; ?>
    </svg>
    <p>Переданный параметр num: <?php echo $num; ?></p>
    <br><a href="/index.php">Назад на главную</a>
</body>
</html>
