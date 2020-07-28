<?php

if (!function_exists('distance')) {
    function distance($fromLat, $fromLong, $toLat, $toLong, $unit = 'KM') {
        $theta = $fromLong - $toLong;
        $dist = sin(deg2rad($fromLat)) * sin(deg2rad($toLat)) +  cos(deg2rad($fromLat)) * cos(deg2rad($toLat)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        switch ($unit) {
            case 'K':
            case 'KM':
                return $miles * 1.609344;
            default:
                return $miles;
        }
    }
}
