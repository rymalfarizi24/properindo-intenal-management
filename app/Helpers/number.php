<?php

function abbreviate($number, $precision = 1)
{
    if ($number < 1000) {
        return $number;
    }

    $units = ['K', 'M', 'B', 'T'];
    $power = floor(log($number, 1000));

    return round($number / 1000 ** $power, $precision) . ' ' . $units[$power - 1];
}
