<?php

if (!function_exists('countries')) {
    function countries(): array
    {
        try {
            $path = base_path('storage/josn/countries.json');
            $json = file_get_contents($path);
            return json_decode($json, true);
        } catch (Exception $e) {
            return [];
        }
    }
}

