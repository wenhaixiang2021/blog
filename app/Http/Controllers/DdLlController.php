<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\admin;
use DB;
class DdLlController extends Controller
{
    public function login(){
        return view('admin.ddll.login');
 }
    public function do_login(){
         $post=request()->except('_token');
         //dd($post);exit;
         $user=Admin::where($post)->first();
         if($user){
             //session 存
         session(['admin'=>$user]);
         request()->session()->save();
         return redirect('/user');
         }
         return redirect('/dl/create')->with('msg','没有此用户');
    }
    public function logout(){
        //session 删除
        session(['username'=>null]);
        request()->session()->save();
        return redirect('/ddll/login');
    }
    public function index(){
        $data=Db::table('user')->paginate(2);
        return view('admin.ddll.index',['data'=>$data]);
    }
}
