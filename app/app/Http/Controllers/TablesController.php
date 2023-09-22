<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TableAddRequest;
use App\Models\Names;
use App\Models\Students;


function switchModel(string $name)
{
	switch ($name) {
		case "names":
			return new Names();
		case "students":
			return new Students();
		default:
			return abort(400);
	}
}


class TablesController extends Controller
{
	/**
	 *	GET /tables/tables[?table=names]
	 *
	 **/
	public function tables(Request $request)
	{
		if ($request->table) {
			$model = switchModel($request->table);
			$response = $model->getAllData();

			return $response;
		}

		return view('tables');
	}


	/**
	 *	POST /tables/add {table=names ...}
	 *
	 **/
	public function add(TableAddRequest $request)
	{
		$json = $request->all();
		$model = switchModel($json["table"]);
		$model->addEntry($json);
	}


	/**
	 *	POST /tables/delete {table=names&id=3 ...}
	 *
	 **/
	public function delete(Request $request)
	{
		$json = $request->all();
		$model = switchModel($json["table"]);
		$model->deleteEntry($json["id"]);
	}


	/**
	 *	GET /tables/clear?table=names
	 *
	 **/
	public function clear(Request $request)
	{
		if ($request->table) {
			$model = switchModel($request->table);
			$model->truncate();
			return redirect()->route("tables");
		}
		
		abort(400);
	}
}
