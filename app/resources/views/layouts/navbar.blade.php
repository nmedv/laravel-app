@extends('layouts.base')

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light border-bottom">
	<!-- Container wrapper -->
	<div class="container mb-2 mt-2 align-items-center justify-content-center">
		<!-- Navbar brand -->
		<a class="navbar-brand me-2" href="{{ route('index') }}">
			<strong>laravel-app</strong>
		</a>

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
				<a
					type="button"
					class="btn btn-outline-primary me-3"
					href="{{ route('login') }}"
				>
					Вход
				</a>
				<a
					type="button"
					class="btn btn-primary me-3"
					href="#"
				>
					Регистрация
				</a>
				
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