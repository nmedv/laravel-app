@extends('layouts.navbar')

@section('title')
	Личный кабинет
@endsection

@section('content')
<div class="m-4">

<h1>Личный кабиент</h1>

<div class="card-body">
	<div class="mb-4">
		<h3 class="mb-2 h6-text">Информация об учетной записи</h3>
		<ul class="list-unstyled">
			<li>
				<span class="subtitle1-text pr-1">Отображаемое имя:</span>
				<span class="opacity-7 subtitle1-text">{{ Auth::user()->name }}</span>
			</li>
			<li>
				<span class="subtitle1-text pr-1">Электронная почта:</span>
				<span class="opacity-7 subtitle1-text">{{ Auth::user()->email }}</span>
			</li>
		</ul>
	</div>
	<div class="mb-4">
	<h3 class="mb-2 h6-text">Управление учетной записью</h3>

	<div class="mt-4">
		<button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#resetPasswordModal">Сменить пароль</button>
		
		<div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		<div class="modal-content">

		<div class="modal-header">
			<h5 class="modal-title" id="resetPasswordModalLabel">Смена пароля</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
		</div>
		<div class="modal-body">
			...
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
			<button type="button" class="btn btn-primary">Подтвердить</button>
		</div>

		</div>
		</div>
		</div>
	</div>

	<div class="mt-4">
		<button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">Удалить учетную запись</button>
		
		<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		<div class="modal-content">

		<div class="modal-header">
			<h5 class="modal-title" id="deleteAccountModalLabel">Удаление учетной записи</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
		</div>
		<div class="modal-body">
			Это действие нельзя оменить! Вы действительно хотите удалить свою учетную запись?
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Нет</button>
			<button type="button" class="btn btn-outline-danger">Да</button>
		</div>

		</div>
		</div>
		</div>
	</div>
</div>

</div>

@endsection