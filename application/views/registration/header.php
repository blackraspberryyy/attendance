<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?= $title ?></title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <!-- Custom fonts for this template-->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <!-- Datatable -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.0.0/dt-1.10.16/datatables.min.css"/>

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
        <script>
            $(document).ready(function ($) {
                var Body = $('body');
                Body.addClass('preloader-site');
            });
            $(window).on('load', function () {
                $('.preloader-wrapper').delay(400).fadeOut();
                $('body').removeClass('preloader-site');
            });
        </script>
        <?php include 'preloader.php' ?>
        
        <style>
            .err_msg{
                position:fixed;
                z-index:20;
                width:700px;
                right:350px;
            }
        </style>
        <?php if (!empty($this->session->flashdata("registration_success"))): ?>
            <div class="err_msg alert alert-success alert-dismissible fade show mx-auto mt-3 fade" role="alert" >
                <strong><i class = "fa fa-check"></i></strong> <?= $this->session->flashdata("registration_success"); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php if (!empty($this->session->flashdata("registration_neutral"))): ?>
            <div class="err_msg alert alert-primary alert-dismissible fade show mx-auto mt-3 fade" role="alert" >
                <strong><i class = "fa fa-check"></i></strong> <?= $this->session->flashdata("registration_neutral"); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>