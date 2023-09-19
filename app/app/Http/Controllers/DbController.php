<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DbRequest;
use App\Models\Db;

class DbController extends Controller
{
	public function getData()
	{
		// $db = new Db();
		
		return view('db');
	}

	public function getJsonData()
	{
		$db = new Db();
		$response = [
			"colinfo" => [
				["Идентификатор", "number", false],
				["Имя",           "text",   true ],
				["Дата рождения", "date",   true ]
			],
			"data" => $db->all()
		];
		
		return $response;
	}

	public function setData(DbRequest $request)
	{
		// return dd($request->input('dob'));
		$db = new Db();
		$db->firstname = $request->input('firstname');
		$db->dob = $request->input('dob');

		$db->save();

		// dd($request->all());
	}
}
