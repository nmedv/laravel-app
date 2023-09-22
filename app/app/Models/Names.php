<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Names extends Model
{
	public $timestamps = false;

	public function getAllData()
	{
		return [
			"primaryIndex" => 0,
			"colinfo" => [
				["id",        "Идентификатор", "number", false],
				["firstname", "Имя",           "text",   true ],
				["dob",       "Дата рождения", "date",   true ]
			],
			"data" => $this->all()
		];
	}


	public function addEntry(array $query)
	{
		return DB::insert(
			"INSERT INTO names (firstname, dob) VALUES (?, ?)",
			[$query["firstname"], $query["dob"]]);	
	}


	public function deleteEntry($id)
	{
		return DB::delete("DELETE FROM names WHERE id = ?", [$id]);
	}
	
	
    use HasFactory;
}
