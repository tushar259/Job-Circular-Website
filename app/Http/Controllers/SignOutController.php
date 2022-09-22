<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignOutController extends Controller
{
    public function signOutFunction(Request $request){
        $request->session()->flush();
        return "success";
        
    }
}
