<?php

namespace App\Models;

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
	
	
    use HasFactory;
}
