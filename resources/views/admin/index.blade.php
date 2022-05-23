<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="locale" content="{{ App::getLocale() }}"/>

    <title>Laravel - admin</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
</head>
<body>
<div id="app">
</div>

@include('get-laravel')

<script type="text/javascript" src="{{ asset('admin-site/js/app.js') }}"></script>
</body>
</html>
