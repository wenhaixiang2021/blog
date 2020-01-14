<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  //echo 123;
    return view('welcome');
});
// //闭包路由
Route::get('/hello', function () {
    return "hello";
});
//控制器方法路由
Route::get('/aa','IndexController@test');
//路由视图
// Route::view('/bb','hello',['name'=>"小温温"]);
// Route::view('/login','login');
// Route::post('/dologin','LoginController@dologin');
// Route::get('tansongyun/{id}',function($id){
//   return '我是'.$id;
// });
// Route::get('/renjialun/{id}/{name?}','LoginController@jialun')->where('id','\d+');
Route::prefix('brand')->middleware('checklogin')->group(function () { 
      Route::get('/create','BrandController@create');
      Route::post('/store','BrandController@store');
      Route::get('','BrandController@index');
      Route::get('/edit/{id}','BrandController@edit');
      Route::post('/update/{id}','BrandController@update');
      Route::post('/destroy/{id}','BrandController@destroy');
      Route::get('/checkOnly','BrandController@checkOnly');
      
});

Route::prefix('student')->group(function () {
  Route::get('/create','StudentController@create');
  Route::get('/store','StudentController@store');
  Route::get('','StudentController@index');
  Route::get('/edit/{id}','StudentController@edit');
  Route::get('/destroy/{id}','StudentController@destroy');
  Route::get('/update/{id}','StudentController@update');
});

Route::prefix('number')->group(function () { 
  Route::get('/create','NumberController@create');
  Route::post('/store','NumberController@store');
  Route::get('/destroy/{id}','NumberController@destroy');
  Route::get('','NumberController@index');
  Route::get('/edit/{id}','NumberController@edit');
  Route::post('/update/{id}','NumberController@update');
});

Route::prefix('book')->group(function () { 
  Route::get('/create','BookController@create');
  Route::post('/store','BookController@store');
  Route::get('','BookController@index');
});

Route::prefix('cate')->group(function () { 
Route::get('/create','CateController@create');
Route::post('/store','CateController@store');
Route::get('','CateController@index');
});
//商品添加
Route::prefix('goods')->group(function () { 
Route::get('/create','GoodsController@create');
Route::post('/store','GoodsController@store');
Route::get('/show/{id}','GoodsController@show');
Route::get('','GoodsController@index');
Route::post('/addcart','GoodsController@addcart');
Route::post('/destroy/{id}','GoodsController@destroy');
Route::get('/cart/{id}','GoodsController@show');
});
Route::get('/news/create','NewsController@create');
Route::post('/news/store','NewsController@store');
Route::get('/news/index','NewsController@index');

Route::get('/dl/create','DlController@create');
Route::post('/dl/store','DlController@store');
Route::get('/logout','DlController@logout');

Route::prefix('article')->group(function () { 
Route::get('/create','ArticleController@create');
Route::post('/store','ArticleController@store');
Route::get('','ArticleController@index');
Route::post('/destroy/{id}','ArticleController@destroy');
Route::get('/edit/{id}','ArticleController@edit');
Route::post('/update/{id}','ArticleController@update');
});

Route::get('/denglu/login','DengluController@login');
Route::post('/denglu/do_login','DengluController@do_login');
Route::get('/logouto','DengluController@logout');

Route::prefix('house')->group(function () { 
Route::get('/create','HouseController@create');
Route::post('/store','HouseController@store');
Route::get('','HouseController@index');
Route::post('/destroy/{id}','HouseController@destroy');
});

//将cookie添加到响应上
Route::get('/set',function(){
  return response('hello')->cookie('n','张三',2);
});
Route::get('/get',function(){
  return request()->cookie('n');
});
//第二种添加
Route::get('/set2',function(){
  Illuminate\Support\Facades\Cookie::queue('name', 'lisi', 1);
  echo request()->cookie('name');
});

Route::get('send','GoodsController@sendemail');

Route::get('/ddll/login','DdLlController@login');
Route::post('/ddll/do_login','DdLlController@do_login');
Route::get('/user','DdLlController@index');

Route::prefix('message')->group(function () { 
Route::get('/create','MessageController@create');
Route::post('/store','MessageController@store');
Route::get('/index','MessageController@index');
Route::get('/destroy/{id}','MessageControllerr@destroy');
Route::get('/edit/{id}','MessageController@edit');
Route::post('/update/{id}','MessageController@update');
Route::post('/info/{id}','MessageController@info');
});