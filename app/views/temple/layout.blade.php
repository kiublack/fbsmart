<!DOCTYPE html>
<html lang="vi">
    <head>
    	 <link rel="shortcut icon" href="http://www.iconsdb.com/icons/preview/royal-blue/book-xxl.png" />
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    	<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		
		<link rel="stylesheet" type="text/css" href="/css/app.css">
    </head>
    <body>
<div class="container-fluid">
<div class="row">
	<div class="col-md-8 col-md-offset-2 header">@include('temple.header')</div>
	<div class="col-md-8 col-md-offset-2 content">@yield('content')</div>
	<div class="col-md-8 col-md-offset-2 footer">@include('temple.footer')</div>
</div>      
</div>
    </body>
</html>