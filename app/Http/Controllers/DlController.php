<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
class DlController extends Controller
{
   public function create(){
       return view('admin.dl.create');
}
   public function store(){
        $post=request()->except('_token');
        //dd($post);exit;
        $user=Admin::where($post)->first();
        if($user){
            //session 存
        session(['admin'=>$user]);
        request()->session()->save();
        return redirect('/goods');
        }
        return redirect('/dl/create')->with('msg','没有此用户');
   }
   public function logout(){
       //session 删除
       session(['username'=>null]);
       request()->session()->save();
       return redirect('/dl/create');
   }
}