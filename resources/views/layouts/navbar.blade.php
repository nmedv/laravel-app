@extends('layouts.base')

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<!-- Container wrapper -->
	<div class="container">
		<!-- Navbar brand -->
		<a class="navbar-brand me-2" href="{{ route('index') }}">laravel-app</a>

		<!-- Collapsible wrapper -->
		<div class="collapse navbar-collapse" id="navbarButtonsExample">
			<!-- Left links -->
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link" href="{{ route('index') }}">Главная</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('db') }}">БД</a>
				</li>
			</ul>
			<!-- Left links -->

			<div class="d-flex align-items-center">
				<button type="button" class="btn btn-link px-3 me-2" >Регистрация</button>
				<button
					type="button"
					class="btn btn-primary me-3"
				>
					Вход
				</button>
				<!-- <a
					class="btn btn-dark px-3"
					href="https://github.com/mdbootstrap/mdb-ui-kit"
					role="button"
				>
					<i class="fab fa-github"></i>
				</a> -->
			</div>
		</div>
		<!-- Collapsible wrapper -->
	</div>
	<!-- Container wrapper -->
</nav>
<!-- Navbar -->