<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Zipcode;

class ImportZipcodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:zipcodes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create zipcodes table in database and import zipcodes from a spreadsheet into zipcodes table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->confirm("\nZipcodes will be imported from a spreadsheet into the `zipcodes` database table.\nDo you wish to continue?")) {
            $i = 1;
            $f = fopen(public_path() . '\zipcodes.csv', "r");
            var_dump($f);
            while ($row = fgetcsv($f)) {
                if ($i !== 1) {       
                    $zipcode = new Zipcode();
                    $zipcode->zipcode = $row[0];
                    $zipcode->latitude = $row[1];
                    $zipcode->longitude = $row[2];
                    $zipcode->save();
                }
                echo "Row $i has been imported\n";
                $i++;
            }
            echo "\nThe import of zipcodes into the zipcodes table is complete.";
        }
        
        return 0;
    }
}
