<?php
require_once __DIR__ . '/../vendor/autoload.php';

if (!function_exists('config')) {
    function config($key)
    {
        return constant($key);
    }
}
