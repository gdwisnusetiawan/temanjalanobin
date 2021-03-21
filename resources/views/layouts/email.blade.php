<!DOCTYPE html>
<html lang="en">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="author" content="INSPIRO"/>
	<meta name="description" content="Themeforest Template Polo, html template">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="{{ $config->favicon_url }}">
	<!-- Document title -->
	<title>Email</title>
	<!-- Stylesheets & Fonts -->
	<link href="{{ asset('polo-5/css/plugins.css') }}" rel="stylesheet">
	<link href="{{ asset('polo-5/css/style.css') }}" rel="stylesheet">
</head>

<body>
	<!-- Body Inner -->
	<div class="body-inner">
	    @yield('content')
	</div> <!-- end: Body Inner -->
	<!-- Scroll top -->
	<a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>
	<!--Plugins-->
	<script src="{{ asset('polo-5/js/jquery.js') }}"></script>
	<script src="{{ asset('polo-5/js/plugins.js') }}"></script>
	<!--Template functions-->
	<script src="{{ asset('polo-5/js/functions.js') }}"></script>
</body>

</html>