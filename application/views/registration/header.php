<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        
        <title><?=$title?></title>
        
        <style>
            /*Styles here*/
            #confirm{
                margin-top:40px;
                padding-left: 80px;
                padding-right: 80px;
            }
            #modal_student_name{
                font-weight:bold;
            }
        </style>
        
        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        
        <script>
            function show_error(form_error, field) {
                if (form_error !== "" || typeof form_error === undefined) {
                    $(field).siblings(".invalid-feedback").remove();
                    $(field).after("<div class = 'invalid-feedback'>" + form_error + "</div>");
                    $(field).removeClass("is-invalid").addClass("is-invalid");
                } else {
                    $(field).siblings(".invalid-feedback").remove();
                    $(field).removeClass("is-invalid");
                }
            }
            
            function remove_error(field) {
                $(field).siblings(".invalid-feedback").remove();
                $(field).removeClass("is-invalid");
            }
        </script>
    </head>
    <body>