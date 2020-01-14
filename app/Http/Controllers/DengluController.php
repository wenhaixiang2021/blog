<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
class DengluController extends Controller
{
    public function login(){
        return view('admin.denglu.denglu');
    }
    public function do_login(){
        $post=request()->except('_token');
        $user=Admin::where($post)->first();
        if($user){
                //session 存
        session(['admin'=>$user]);
        request()->session()->save();
        return redirect('/article');
        }
    }
    public function logout(){
          //session 删除
       session(['username'=>null]);
       request()->session()->save();
       return redirect('/denglu/login');
        
    }
}
