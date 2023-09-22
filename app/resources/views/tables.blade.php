@extends('layouts.navbar')

@section('meta')
	<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('title')
	Таблицы
@endsection

@section('scripts')
	<script type="module">
		import TableEditor from "./table.js";

		var tables = ["names", "students"];
		for (var table of tables) {
			var tableEditor = new TableEditor(table);
			document.getElementById('content-block').appendChild(tableEditor.element);
			tableEditor.init();
		}
		
	</script>
@endsection