<DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>@yield('title')</title>

	<!-- Fonts -->

	<!-- Font Awesome -->
	<link
		href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
		rel="stylesheet"
	/>

	<!-- Google Fonts -->
	<link
		href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
		rel="stylesheet"
	/>

	<!-- Styles -->

	<link
		href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css"
		rel="stylesheet"
	/>

</head>
<bode>
	@yield('navbar')
	@yield('content')

	<!-- <footer>
		<div class="text-center p-4">
			© 2023 Copyright: Никакие права не защищены ...
		</div>
	</footer> -->

	<!-- MDB -->
	<script
		type="text/javascript"
		src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"
	></script>
</body>
</html>