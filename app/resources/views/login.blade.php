@extends('layouts.base')

@section('title')
	Вход
@endsection

@section('content')
<div class="container border rounded-6 mt-5 shadow" style="width: fit-content">
<section class="w-100 p-4 d-flex justify-content-center pb-4">
<form style="width: 22rem;">


<h3 class="mb-5 text-center">Вход</h3>
<!-- Email input -->
<div class="form-floating mb-4">
	<input type="email" id="form1Example1" class="form-control" placeholder="login"/>
	<label for="form1Example1">Логин</label>
</div>

<!-- Password input -->
<div class="form-floating mb-4">
	<input type="password" id="form1Example2" class="form-control" placeholder="Password"/>
	<label for="form1Example1">Пароль</label>
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


</form>
</section>
</div>
@endsection