@extends('layouts.auth-box')

@section('title')
	Сброс пароля
@endsection

@section('box-content')

<h4 class="mb-2 h6-text mb-4">Сброс пароля</h4>
<span>Введите адрес электронной почты на который необходимо прислать ссылку для сброса пароля:</span>
<div class="my-4">
	<form method="POST" action="{{ route('password.email') }}">
		@csrf

		<!-- Email input -->
		<div class="form-floating mt-4">
			<input type="email" id="email" name="email" class="form-control @error('email') border-danger @enderror" placeholder="email"/>
			<label for="email">Электронная почта</label>
		</div>
		@error('email')@include('components.form-error')@enderror

		@if(session()->has('status'))
		<div class="row mt-4">
			<div class="col d-flex justify-content-start">
				<p class="text-success mb-0">{{ session()->get('status') }}</p>
			</div>
		</div>
		@endif

		<button type="submit" class="btn btn-outline-primary mt-4">Подтвердить</button>
	</form>
</div>
<hr>
<span>Если письмо не пришло, проверьте папку «Спам», если письмо не найдено и там, нажмите еще раз кнопку «Подтвердить».</span>

@endsection