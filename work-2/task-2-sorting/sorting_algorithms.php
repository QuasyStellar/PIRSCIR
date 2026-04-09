<?php
// sorting_algorithms.php

function quickSort(array $arr): array {
    $len = count($arr);
    if ($len <= 1) {
        return $arr;
    }

    $pivot = $arr[0];
    $left = $right = [];

    for ($i = 1; $i < $len; $i++) {
        if ($arr[$i] < $pivot) {
            $left[] = $arr[$i];
        } else {
            $right[] = $arr[$i];
        }
    }

    return array_merge(quickSort($left), [$pivot], quickSort($right));
}

// Helper function to parse comma-separated string to array
function parseArrayString(string $array_str): array {
    $elements = explode(',', $array_str);
    return array_map('intval', $elements); // Convert elements to integers
}

// Helper function to format array for display
function formatArrayForDisplay(array $arr): string {
    return '[' . implode(', ', $arr) . ']';
}
?>
