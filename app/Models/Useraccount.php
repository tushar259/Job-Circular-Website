<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Useraccount extends Model
{
    //use HasFactory;
    protected $table = "useraccount";
    protected $primaryKey ="id";
	public $timestamps = false;
}
