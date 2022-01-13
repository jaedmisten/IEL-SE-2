<?php

namespace App\Services;

class DistanceService {
    public function calculateDistance($coordinates) 
    {
        $totalDistance = 0;
        for ($i = 0; $i < count($coordinates) - 1; $i++) {
            $lat1 = $coordinates[$i][0];
            $lat1Radian = $lat1 * pi() / 180;
            $long1 = $coordinates[$i][1];
            $long1Radian = $long1 * pi() / 180;
            $lat2 = $coordinates[$i + 1][0];
            $lat2Radian = $lat2 * pi() / 180;
            $long2 = $coordinates[$i + 1][1];
            $long2Radian = $long2 * pi() / 180;
            
            $distance = 2 * 3961 * asin(sqrt(pow(sin(($lat2Radian - $lat1Radian)/2), 2) + cos($lat1Radian) * cos($lat2Radian) * pow(sin(($long2Radian - $long1Radian)/2) , 2)));
            $totalDistance += $distance;
        }
        return $totalDistance;
    }
}

