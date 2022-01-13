<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zipcode extends Model
{
    use HasFactory;
    
    public function getCoordinates($zipcodes) 
    {
        $coordinates = [
            'missing' => [],
            'found'   => []
        ];
        for ($i = 0; $i < count($zipcodes); $i++) {
            $coordinate = Zipcode::where('zipcode', '=', $zipcodes[$i])->first();
            if ($coordinate) {
                $coordinates['found'][] = [ 
                    $coordinate['latitude'], 
                    $coordinate['longitude'] 
                ];
            } else {
                $coordinates['missing'][] = $zipcodes[$i];
            }
        }
        return $coordinates;
    }
}
