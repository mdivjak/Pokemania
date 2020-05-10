<!DOCTYPE html>
<html>

<head>
	<title>Pokemania - @yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@600&display=swap" rel="stylesheet">

	@yield('css')
	<link rel="stylesheet" href="{{ URL::to('css/styles.css') }}">
	<link rel="icon" href="{{ URL::to('images/pokeball.ico') }}">

	@yield('scripts')
	

</head>

<body>

	@include('partials.nav')

	<div class="container">
		@yield('content')
	</div>

</body>

</html>