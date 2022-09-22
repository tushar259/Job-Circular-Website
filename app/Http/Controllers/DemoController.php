<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function ThisMethod(){
        return "hello This method";
    }
    public function ThatMethod(){
        return "hello That method";
    }
}
