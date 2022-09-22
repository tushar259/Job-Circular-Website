<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Circular extends Model
{
    //use HasFactory;
    protected $table = "circular";
    protected $primaryKey ="id";
	public $timestamps = false;
}
