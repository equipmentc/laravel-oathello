<?php
if (!function_exists('config')) {
    function config($key) {
        return strstr($key, 'endpoint')
            ? ENDPOINT
            : KEY;
    }
}
