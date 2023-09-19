<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Column
{
	public string $fullname;
	public string $inptype;
	public bool   $editable;

	function __contruct(string $fullname, string $inptype, bool $editable)
	{
		$this->fullname = $fullname;
		$this->inptype  = $inptype;
		$this->editable = $editable;
	}
}

class Db extends Model
{
	public $timestamps = false;
	
    use HasFactory;
}
