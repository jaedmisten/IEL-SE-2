A live version of this web application can be viewed here: http://distance.techgeekgalaxy.com

This was written with the following:
Laravel 8,
MySQL,
jQuery 3.6,
Bootstrap 5.1.3

This web app accepts two or more zipcodes and calculates the distance to travel 
from the first to the last using the haversine formula.

The UI provides two input fields to enter zipcodes. The 'Add Zipcode Field' button
is used to add additional zipcode inputs. Additional zipcode input fields have a 
remove link next to them to remove the field from the DOM.

The 'calculate_distance_app.sql' in the root of this project is the database schema
needed for this app. It is configured to be imported into a database named
calculate_distance_app and create a table named zipcodes and then import zipcodes
with their latitude/longitude coordinates.
