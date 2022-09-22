<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Changepassword extends Model
{
    // use HasFactory;
    protected $table = "changepassword";
    protected $primaryKey ="id";
	public $timestamps = false;
}
