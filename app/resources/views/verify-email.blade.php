@extends('layouts.auth-box')

@section('title')
	Подтвердите адрес электронной почты
@endsection

@section('box-content')

<h4 class="mb-2 h6-text mb-4">Подтвердите адрес электронной почты</h4>
<span>На указанный адрес электронной почты было отправлено письмо с ссылкой для подтверждения аккаунта.</span>
<div class="text-center my-4">
	<form method="POST" action="/email/verification-notification">
		@csrf
		<button type="submit" class="btn btn-outline-primary">ОТПРАВИТЬ ПИСЬМО ПОВТОРНО</button>
	</form>
</div>
<hr>
<span>Если письмо не пришло, проверьте папку «Спам», если письмо не найдено и там, нажмите кнопку выше.</span>

@endsection