<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function test(){
        $post=request()->all();
        dd($post);
    }
    public function jialun($id,$name="谭松韵"){
        echo $id.$name;
    }
}
