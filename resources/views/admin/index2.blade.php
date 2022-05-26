<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="locale" content="{{ App::getLocale() }}"/>
    <title>AdminLTE 2 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('admin-site/template/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('admin-site/template') }}/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin-site/template') }}/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('admin-site/template') }}/dist/css/skins/_all-skins.min.css">

    <link rel="stylesheet" href="{{ asset('flag-icons-master/css/flag-icon.css') }}">
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('ckfinder/ckfinder.js') }}"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    {{-- alerttify--}}
    <link rel="stylesheet" href="{{ asset('alertify/alertify.bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('alertify/alertify.core.css')}}">
    <link rel="stylesheet" href="{{ asset('alertify/alertify.default.css')}}">
    <script src="{{ asset('alertify/alertify.min.js') }}"></script>
    {{-- alerttify--}}
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div id="app">
    </div>

    @include('get-laravel')
<!-- ./wrapper -->


<script type="text/javascript" src="{{ asset('admin-site/js/app.js') }}"></script>
<!-- jQuery 2.1.4 -->
<script src="{{ asset('admin-site/template') }}/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{ asset('admin-site/template') }}/bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="{{ asset('admin-site/template') }}/plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin-site/template') }}/dist/js/app.js"></script>
<!-- Sparkline -->
<script src="{{ asset('admin-site/template') }}/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="{{ asset('admin-site/template') }}/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="{{ asset('admin-site/template') }}/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="{{ asset('admin-site/template') }}/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="{{ asset('admin-site/template') }}/plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('admin-site/template') }}/dist/js/demo.js"></script>
</body>
</html>
