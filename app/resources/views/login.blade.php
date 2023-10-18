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

<h3 class="mb-4">Вход</h3>

@csrf

@error('login')
<p class="text-danger">{{ $message }}</p>
@enderror

<!-- Email input -->
@error('email')
<p class="text-danger">{{ $message }}</p>
@enderror
<div class="form-floating mb-4">
	<input type="email" id="email" name="email" class="form-control @error('email') border-danger @enderror" placeholder="login"/>
	<label for="email">Электронная почта</label>
</div>

<!-- Password input -->
@error('password')
<p class="text-danger">{{ $message }}</p>
@enderror
<div class="form-floating mb-4">
	<input type="password" id="password" name="password" class="form-control @error('password') border-danger @enderror" placeholder="Password"/>
	<label for="password">Пароль</label>
</div>

<!-- 2 column grid layout for inline styling -->
<div class="row mb-4">
	<div class="col d-flex justify-content-center">
	<!-- Checkbox -->
	<div class="form-check">
		<input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
		<label class="form-check-label" for="form1Example3"> Запомнить меня </label>
	</div>
	</div>

	<div class="col">
	<!-- Simple link -->
	<a href="#!">Забыли пароль?</a>
	</div>
</div>

<!-- Submit button -->
<button type="submit" class="btn btn-primary btn-block">Войти</button>


</div>
</div>
</div>
</div>
</div>
@endsection