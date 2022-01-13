<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Distance Calculator</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <style>
            .zipcode-field {
                padding-bottom: 10px;
            }
            #distance {
                display: none;
                font-size: 22px;
            }
            #missing {
                display: none;
            }
            #error {
                display: none;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h1 style="text-align:center;">Distance Calculator</h1>
                    <div style="padding-bottom:6px;"><button type="button" id="addZipcodeBtn" class="btn btn-info btn-sm">Add Zipcode Field</button></div>
                    <form id="getDistanceForm" name="getDistanceForm">
                        <div class="row g-3 align-items-center zipcode-field">
                            <div class="col-auto"><label for="zipcode1" class="col-form-label">Zipcode 1: </label></div>
                            <div class="col-auto"><input type="text" id="zipcode1" class="form-control"></div>
                            <br><br>
                        </div>
                        <div class="row g-3 align-items-center zipcode-field">
                            <div class="col-auto"><label for="zipcode2" class="col-form-label">Zipcode 2: </label></div>
                            <div class="col-auto"><input type="text" id="zipcode2" class="form-control"></div>
                            <br>
                        </div>
                        <input type="button" id="submit" class="btn btn-primary" name="submit" value="Submit">
                    </form>
                    <br>
                    <div id="distance"></div>
                    <div id="missing" class="alert alert-danger"></div>
                    <div id="error" class="alert alert-danger"></div>
                </div>
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function() {
            let numZipcodes = 2;

            $('#addZipcodeBtn').click(function(e) {
                e.preventDefault();
                numZipcodes++;
                let zipcodeField = $('<div id="field' + numZipcodes + '" class="row g-3 align-items-center zipcode-field"><div class="col-auto"><label for="zipcode' + numZipcodes + '" class="col-form-label">Zipcode ' + numZipcodes + ': </label></div><div class="col-auto"><input type="text" id="zipcode' + numZipcodes +'" class="form-control"></div></div>');
                let removeLink = $('<div class="col-auto"><button type="button" class="remove-link btn btn-link">remove</button></div>');
                zipcodeField.append(removeLink);
                $('#getDistanceForm').append(zipcodeField);
                $('#submit').before(zipcodeField);

                removeLink.click(function(e) {
                    e.preventDefault();
                    $('#field' + numZipcodes).remove();
                    numZipcodes--;
                });
            });
            
            $('#submit').click(function(e) {
                e.preventDefault();
                $('#distance').hide();
                $('#missing').hide();
                $('#error').hide();

                let zipcodes = [];
                for (let i = 1; i <= numZipcodes; i++) {
                    zipcode = $('#zipcode' + i).val().trim();
                    if (zipcode === '') {
                        $('#error').html('Request not sent. Please check that all input fields have a value.').show();
                        return;
                    }
                    zipcodes.push(zipcode);
                }
                
                $.ajax({
                    url: '/get-distance',
                    type: 'post',
                    data: {
                        _token: "{{csrf_token()}}",
                        zipcodes: zipcodes
                    },
                    success: function (response) {
                        if (response.hasOwnProperty('distance')) {
                            $('#distance').html('Total Distance: ' + response.distance.toFixed(3) + ' miles').show();
                        } else if (response.hasOwnProperty('missing')) {
                            let missingMsg = 'The following ' + ((response.missing.length === 1) ? 'zipcode was' : 'zipcodes were') + ' not found:<br><ul>';
                            for (let i = 0; i < response.missing.length; i++) {
                                missingMsg += '<li>' + response.missing[i] + '</li>';
                            }
                            missingMsg += '</ul>';
                            $('#missing').html(missingMsg).show();
                        }
                    },
                    error: function (response) {
                        $('#error').html('There was an error calculating the total distance.').show();
                    }
                });
            });
        });
    </script>
</html>
