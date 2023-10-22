@extends('layouts.auth-box')

@section('title')
	Адрес электронной почты успешно подтвержден
@endsection

@section('box-content')

<h4 class="mb-2 h6-text mb-4">Адрес электронной почты успешно подтвержден</h4>
<span><a href="{{ route('index') }}">Главная страница</a></span>

@endsection