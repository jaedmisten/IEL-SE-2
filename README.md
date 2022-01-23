A live version of this web application can be viewed here: http://distance.techgeekgalaxy.com

This was written with the following:
Laravel 8,
PHP 7.4.25,
MySQL,
jQuery 3.6,
Bootstrap 5.1.3

This web app accepts two or more zipcodes and calculates the distance to travel 
from the first to the last using the haversine formula.

The UI provides two input fields to enter zipcodes. The 'Add Zipcode Field' button
is used to add additional zipcode inputs. Additional zipcode input fields have a 
remove link next to them to remove the field from the DOM.

This app requires a database with a table named `zipcodes` with data for the
zipcode, latitude, and longitude. There are two options to import this data.

    1. Use the command "php artisan migrate" to run the migration to create the 
`zipcodes` table. Then run the custom artisan command "php artisan import:zipcodes"
to import the zipcode data from a spreadsheet into the `zipcodes` table.

    2. The 'calculate_distance_app.sql' in the root of this project is the database 
schema needed for this app. It is configured to be imported into a MySQL database 
named calculate_distance_app and create a table named zipcodes and then import 
zipcodes with their latitude/longitude coordinates.
