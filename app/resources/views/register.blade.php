@extends('layouts.base')

@section('title')
	Регистрация
@endsection

@section('content')
<div class="container p-4">
<div class="row justify-content-center">
<div class="col-12 col-md-8 col-lg-6 col-xl-5">
<div class="card shadow-sm" style="border-radius: 1rem;">
<div class="card-body p-5 text-center">

<form method="POST" action="{{ route('register.process') }}">

<h3 class="mb-5">Регистрация</h3>

@csrf

<!-- Name input -->
<div class="form-floating">
	<input type="text" id="name" name="name" class="form-control @error('name') border-danger @enderror" placeholder="name"/>
	<label for="name">Имя пользователя</label>
</div>
@error('name')@include('components.form-error')@enderror


<!-- Email input -->
<div class="form-floating mt-4">
	<input type="email" id="email" name="email" class="form-control @error('email') border-danger @enderror" placeholder="email"/>
	<label for="email">Электронная почта</label>
</div>
@error('email')@include('components.form-error')@enderror

<!-- Password input -->
<div class="form-floating mt-4">
	<input type="password" id="password" name="password" class="form-control @error('password') border-danger @enderror" placeholder="Password"/>
	<label for="password">Пароль</label>
</div>
@error('password')@include('components.form-error')@enderror

<!-- Password confirm input -->
<div class="form-floating mt-4">
	<input type="password" id="password_confirm" name="password_confirmation" class="form-control @error('password_confirmation') border-danger @enderror" placeholder="Password"/>
	<label for="password_confirm">Повторите пароль</label>
</div>
@error('password_confirmation')@include('components.form-error')@enderror

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
<div class="container mt-4 px-0">
	<div class="row g-2">
		<div class="col">
			<a type="button" href="{{ route('login') }}" class="btn btn-outline-primary w-100">Вход</a>
		</div>
		<div class="col">
			<button type="submit" class="btn btn-primary w-100">Зарегистрироваться</button>
		</div>
	</div>
</div>

</form>

</div>
</div>
</div>
</div>
</div>
@endsection