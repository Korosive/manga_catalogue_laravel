<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ $title ?? 'Manga Lister' }}</title>
</head>
<body>
	@section('navbar')
		<ul>
		  <li><a href="/"></a></li>
		  <li><a href="/search?page=1">Search</a></li>
		</ul>
	@endsection

	<div class="container">
		@yield('content')
	</div>
</body>
</html>