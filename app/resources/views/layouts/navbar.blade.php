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
		</ul>
		<ul class="navbar-nav flex-row ml-md-auto d-md-flex">
			@auth('web')
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle text-primary" href="#" id="navbarScrollingDropdown" data-bs-toggle="dropdown" aria-expanded="false">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
						<path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
					</svg>
					{{ Auth::user()->name }}
				</a>
				<div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarScrollingDropdown">
					<a class="dropdown-item" href="{{ route('cabinet') }}">Личный кабинет</a>
					<div class="dropdown-divider"></div>
					<a type="button" class="dropdown-item text-danger" href="{{ route('logout') }}">Выйти</a>
				</div>
			</li>
			@endauth

			@guest('web')
			<li class="nav-item">
				<a type="button" class="btn btn-outline-primary me-3" href="{{ route('login') }}">
					Войти
				</a>
			</li>
			<li class="nav-item">
				<a type="button" class="btn btn-primary me-3" href="{{ route('register') }}">
					Регистрация
				</a>
			</li>
			@endguest
		</ul>
	</div>
</div>
</nav>

@endsection