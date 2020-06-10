<?php
if (!function_exists('config')) {
    function config($key)
    {
        return constant($key);
    }
}
