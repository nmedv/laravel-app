<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DbRequest;
use App\Models\Db;

class DbController extends Controller
{
	public function getData()
	{
		$db = new Db();
		
		return $db->all();
	}

	public function setData(DbRequest $request)
	{
		$db = new Db();
		$db->firstname = $request->input('firstname');
		$db->dob = $request->input('dob');

		$db->save();

		return redirect()->route('db')->with('success', 'Запись добавлена');
	}
}
