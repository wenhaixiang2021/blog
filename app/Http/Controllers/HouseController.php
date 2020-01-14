<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\House;
class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=House::paginate(2);
        return view('admin.house.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.house.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post=$request->except('_token');
        if($request->hasFile('house_file')){
            $post['house_file']=$this->upload('house_file');
        }
        $res=House::insert($post);
        if($res){
            return redirect('/house');
        }
    }

    public function upload($filename){
        if (request()->file($filename)->isValid()) { 
            //接受文件
            $photo = request()->file($filename);
            //上传文件
            $store_result = $photo->store('public');  //文件的位置
            return $store_result;
    }
         exit('没有文件上传或者文件上传失败');
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
        $res=house::where('house_id','=',$id)->delete();
        if($res){
            if(request()->ajax()){
                echo json_encode(['code'=>00000,'msg'=>'删除成功']);die;
            }
            return redirect('/house');
        }
    }
}
