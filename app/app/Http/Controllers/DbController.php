<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DbRequest;
use App\Models\Names;

class DbController extends Controller
{
	private function _switchModel(string $name)
	{
		switch ($name)
		{
			case "names":
				return new Names();
			default:
				return NULL;
		}
	}

	public function getDbPage()
	{		
		return view('db');
	}

	public function getData(Request $request)
	{
		$model = _switchModel($request->table);
		$response = $model->getAllData();

		return $response;
	}

	public function addEntry(DbRequest $request)
	{
		$db = new Db();
		$db->firstname = $request->input('firstname');
		$db->dob = $request->input('dob');

		$db->save();
	}

	public function deleteEntry()
	{
		
	}

	public function removeData(Request $request)
	{
		$model = _switchModel($table);
		$model->truncate();

		return redirect()->route("db");
	}
}
