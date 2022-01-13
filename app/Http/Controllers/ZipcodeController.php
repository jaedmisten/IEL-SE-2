<?php

namespace App\Http\Controllers;

use App\Models\Zipcode;
use App\Services\DistanceService;
use Illuminate\Http\Request;

class ZipcodeController extends Controller
{
    public function getDistance(Request $request) 
    {
        $zipcodes = $request->input('zipcodes');
        $coordinates = Zipcode::getCoordinates($zipcodes);
        if (!empty($coordinates['missing'])) {
            return ['missing' => $coordinates['missing']];
        }
        $distance = DistanceService::calculateDistance($coordinates['found']);
        return ['distance' => $distance];
    } 
}
