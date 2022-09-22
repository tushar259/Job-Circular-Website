<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userpayhistory extends Model
{
    // use HasFactory;
    protected $table = "userpayhistory";
    protected $primaryKey ="id";
	public $timestamps = false;
}
