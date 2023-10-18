@extends('layouts.base')

@section('title')
	Регистрация
@endsection

@section('content')
<div class="container p-4">
<div class="row justify-content-center">
<div class="col-12 col-md-8 col-lg-6 col-xl-4">
<div class="card shadow-sm" style="border-radius: 1rem;">
<div class="card-body p-5 text-center">

<form method="POST" action="{{ route('register.process') }}">

<h3 class="mb-4">Регистрация</h3>

@csrf

<!-- Name input -->
@error('name')
<p class="text-danger">{{ $message }}</p>
@enderror
<div class="form-floating mb-4">
	<input type="text" id="name" name="name" class="form-control @error('name') border-danger @enderror" placeholder="name"/>
	<label for="name">Имя пользователя</label>
</div>

<!-- Email input -->
@error('email')
<p class="text-danger">{{ $message }}</p>
@enderror
<div class="form-floating mb-4">
	<input type="email" id="email" name="email" class="form-control @error('email') border-danger @enderror" placeholder="email"/>
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

<!-- Password confirm input -->
@error('password_confirmation')
<p class="text-danger">{{ $message }}</p>
@enderror
<div class="form-floating mb-4">
	<input type="password" id="password_confirm" name="password_confirmation" class="form-control @error('password_confirmation') border-danger @enderror" placeholder="Password"/>
	<label for="password_confirm">Повторите пароль</label>
</div>

<!-- Submit button -->
<div class="d-flex justify-content-center">
	<button type="submit" class="btn btn-primary btn-block p-3 mt-4">Зарегистрироваться</button>
</div>

</form>

</div>
</div>
</div>
</div>
</div>
@endsection