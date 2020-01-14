<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function test(){
        $name="温海香";
        return view('hello',['name'=>$name]);
    }
}
