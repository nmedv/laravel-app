@extends('layouts.navbar')

@section('meta')
	<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('title')
	БД
@endsection

@section('scripts')
	<!-- <script type="module" src="http://localhost/table.js"></script> -->
	<script type="module" src="http://localhost/db.js"></script>
@endsection