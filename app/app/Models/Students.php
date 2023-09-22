<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
	public $timestamps = false;


	public function getAllData()
	{
		return [
			"primaryIndex" => 0,
			"colinfo" => [
				["regnum",     "Регистрационный номер", "number", false],
				["firstname",  "Имя",                   "text",   true ],
				["secondname", "Фамилия",               "text",   true ],
				["midname",    "Отчество",              "text",   true ],
				["dob",        "Дата рождения",         "date",   true ],
				["city",       "Город",                 "text",   true ],
				["school",     "Учебное заведение",     "text",   true ]
			],
			"data" => $this->all()
		];
	}


	public function addEntry(array $query)
	{
		return DB::insert(
			"INSERT INTO students (firstname, secondname, midname, dob, city, school)
			VALUES (?, ?, ?, ?, ?, ?)",
			[
				$query["firstname"],
				$query["secondname"],
				$query["midname"],
				$query["dob"],
				$query["city"],
				$query["school"],
			]
		);	
	}


	public function deleteEntry($id)
	{
		return DB::delete("DELETE FROM students WHERE regnum = ?", [$id]);
	}

    use HasFactory;
}
