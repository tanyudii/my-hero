<?php

if (!function_exists('distance')) {
    /**
     * @param float $fromLat
     * @param float $fromLong
     * @param float $toLat
     * @param float $toLong
     * @param string $unit
     *
     * @return float
     */
    function distance(float $fromLat, float $fromLong, float $toLat, float $toLong, string $unit = 'KM') {
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
