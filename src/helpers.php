<?php

if (!function_exists('api')) {
    function api()
    {
        return new \Kolirt\ApiResponse\Api;
    }
}