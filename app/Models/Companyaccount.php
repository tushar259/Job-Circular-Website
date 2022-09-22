<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companyaccount extends Model
{
    //use HasFactory;
    protected $table = "companyaccount";
    protected $primaryKey ="id";
	public $timestamps = false;
}
