@extends('layouts.auth-box')

@section('title')
	Смена пароля
@endsection

@section('box-content')

<h4 class="mb-2 h6-text mb-4">Смена пароля</h4>
<div class="text-center my-4">
<form method="POST" action="{{ route('password.update') }}">

@csrf

<input type="hidden" name="token" value="{{ $token }}"/>

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

<button type="submit" class="btn btn-outline-primary mt-4">Сменить пароль</button>
</form>
</div>

@endsection