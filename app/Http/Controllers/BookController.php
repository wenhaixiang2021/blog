<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //showMsg(1,'Hello World!');
        $data=Book::paginate(2);
        return view('admin.book.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.book.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //表单验证
        $validatedData = $request->validate([
             'book_name' => 'required|unique:book|max:255',
              
        ],[
            'book_name.required'=>'名称必填',
            'book_name.unique'=>'已有该名称',
        ]);
        $post=$request->except('_token');
        //文件上传
        if ($request->hasFile('book_file')) { 
            $post['book_file']=$this->upload('book_file');
         }
        $res=Book::insert($post);
        if($res){
            return redirect('/book');
        }
    }

    public function upload($filename){
        if ( request()->file($filename)->isValid()) {
             $photo = request()->file($filename);
             $store_result = $photo->store('upload');
             return  $store_result;
            } 
            exit('未获取到上传文件或上传过程出错');     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
