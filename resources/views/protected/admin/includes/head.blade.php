<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Title site</title>

    <!-- Bootstrap core CSS -->

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/fonts/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/animate.min.css') }}" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/maps/jquery-jvectormap-2.0.1.css') }}" />
    <link href="{{ asset('assets/css/icheck/flat/green.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/floatexamples.css') }}" rel="stylesheet" type="text/css" />

    {{--pace style--}}
    <link href="{{ asset('assets/css/pace/pace.css') }}" rel="stylesheet" />

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/nprogress.js') }}"></script>
    <script>
        NProgress.start();
    </script>
    
    <!--[if lt IE 9]>
        <script src="{{ asset('assets/../assets/js/ie8-responsive-file-warning.js') }}"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>
<body class="nav-md">
<div class="loader" style="display: none;"></div>
<div class="container body">
        <div class="main_container">