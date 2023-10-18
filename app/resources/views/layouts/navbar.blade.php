@extends('layouts.base')

@section('navbar')

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light border-bottom">
<div class="container-fluid mx-3">
	<!-- Navbar brand -->
	<a class="navbar-brand" href="{{ route('index') }}">
			<strong>laravel-app</strong>
	</a>

	<button
		class="navbar-toggler"
		type="button"
		data-bs-toggle="collapse"
		data-bs-target="#navbarButtons"
		aria-controls="navbarButtons"
		aria-expanded="false"
		aria-label="Переключатель навигации"
	>
		<span class="navbar-toggler-icon"></span>
	</button>

	<!-- Collapsible wrapper -->
	<div class="collapse navbar-collapse" id="navbarButtons">
		<ul class="navbar-nav me-auto mb-2 mb-lg-0">
			<li class="nav-item">
				<a class="nav-link" aria-current="page" href="{{ route('index') }}">Главная</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ route('tables') }}">Таблицы</a>
			</li>
		</ul>
		<div class="d-flex">
			@auth('web')
			<a type="button" class="btn btn-outline-primary me-3" href="{{ route('logout') }}">
				Выйти
			</a>
			@endauth
			@guest('web')
			<a type="button" class="btn btn-outline-primary me-3" href="{{ route('login') }}">
				Войти
			</a>
			<a type="button" class="btn btn-primary me-3" href="{{ route('register') }}">
				Регистрация
			</a>
			@endguest
		</div>
	</div>
</div>
</nav>

@endsection