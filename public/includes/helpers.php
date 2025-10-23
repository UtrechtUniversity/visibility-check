<?php
/**
 * Debug functions
 */
function debug($val)
{
    echo '<pre>';
    print_r($val);
    echo '</pre>';
}

function dd($val)
{
    $dbgt = debug_backtrace();
    echo "<p style='font-size: 0.6em'> In {$dbgt[0]['file']} line {$dbgt[0]['line']}</p>";
    echo '<pre>';
    print_r($val);
    echo '</pre>';
    die();
}