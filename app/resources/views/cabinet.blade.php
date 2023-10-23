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
				<span class="subtitle1-text pr-1">Email:</span>
				<span class="opacity-7 subtitle1-text">{{ Auth::user()->email }}</span>
			</li>
		</ul>
	</div>
	<div class="mb-4">
		<div class="mb-4">
			<button class="btn btn-outline-primary">Сменить пароль</button>
		</div>
		<div>
			<button class="btn btn-outline-danger">Удалить учетную запись</button>
		</div>
	</div>
</div>

</div>

@endsection