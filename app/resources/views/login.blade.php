@extends('layouts.base')

@section('title')
	Вход
@endsection

@section('content')
<div class="container p-4">
<div class="row justify-content-center">
<div class="col-12 col-md-8 col-lg-6 col-xl-5">
<div class="card shadow-sm" style="border-radius: 1rem;">
<div class="card-body p-5 text-center">

<form method="POST" action="{{ route('login.process') }}">

<h3 class="mb-5">Вход</h3>

@csrf

<!-- Email input -->

<div class="form-floating">
	<input type="email" id="email" name="email" class="form-control @error('email') border-danger @enderror" placeholder="login"/>
	<label for="email">Электронная почта</label>
</div>
@error('email')@include('components.form-error')@enderror

<!-- Password input -->
<div class="form-floating mt-4">
	<input type="password" id="password" name="password" class="form-control @error('password') border-danger @enderror" placeholder="Password"/>
	<label for="password">Пароль</label>
</div>
@error('password')@include('components.form-error')@enderror

@error('login')
<div class="row mt-4">
	<div class="col d-flex justify-content-start">
		<p class="text-danger mb-0">{{ $message }}</p>
	</div>
</div>
@enderror

<!-- 2 column grid layout for inline styling -->
<div class="row mt-4">
	<div class="col d-flex justify-content-start">
	<!-- Checkbox -->
	<div class="form-check">
		<input class="form-check-input" type="checkbox" name="remember" id="form1Example3" checked />
		<label class="form-check-label" for="form1Example3"> Запомнить меня </label>
	</div>
	</div>
</div>

<!-- Submit button -->
<div class="row mt-4">
	<div class="d-flex flex-column">
		<button type="submit" class="btn btn-primary">Войти</button>
	</div>
</div>

<!-- Simple link -->
<div class="row mt-4">
	<div class="col d-flex justify-content-start">
		<a href="#!">Забыли пароль?</a>
	</div>
</div>
<div class="row">
	<div class="col d-flex justify-content-start">
		<a href="{{ route('register') }}">Регистрация</a>
	</div>
</div>

</div>
</div>
</div>
</div>
</div>
@endsection