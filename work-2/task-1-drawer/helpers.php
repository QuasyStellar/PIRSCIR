<?php
// helpers.php

const SHAPE_CIRCLE = 0;
const SHAPE_RECTANGLE = 1;
const SHAPE_TRIANGLE = 2;

const COLORS = [
    0 => 'red',
    1 => 'blue',
    2 => 'green',
    3 => 'yellow',
    4 => 'black',
    5 => 'orange',
    6 => 'purple',
    7 => 'cyan'
];

function drawCircle($size, $color) {
    $radius = $size / 2;
    return "<circle cx='50' cy='50' r='{$radius}' fill='{$color}' />";
}

function drawRectangle($size, $color) {
    $width = $size;
    $height = $size;
    $x = (100 - $width) / 2;
    $y = (100 - $height) / 2;
    return "<rect x='{$x}' y='{$y}' width='{$width}' height='{$height}' fill='{$color}' />";
}

function drawTriangle($size, $color) {
    $half = $size / 2;
    $top = 50 - $half;
    $bottom = 50 + $half;
    $left = 50 - $half;
    $right = 50 + $half;
    $points = "50,{$top} {$right},{$bottom} {$left},{$bottom}";
    return "<polygon points='{$points}' fill='{$color}' />";
}
?>
