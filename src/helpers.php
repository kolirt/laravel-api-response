<?php

if (!function_exists('api')) {
    function api()
    {
        static $api;

        if (!$api) {
            $api = new \Kolirt\ApiResponse\Api;
        }

        return $api;
    }
}