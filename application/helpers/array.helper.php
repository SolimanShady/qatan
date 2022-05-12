<?php
function array_size($array)
{
    if (!function_exists('count')) {
        $counter = 0;
        foreach ($array as $ar) {
            $counter++;
        }
        return $counter;
    }
    return count($array);
}

function array_last($array)
{
    return end($array);
}

function array_first($array)
{
    return current($array);
}

?>
