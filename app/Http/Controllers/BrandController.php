<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Brand;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $word=request()->brand_name??'';
        //Cache::flush();
        //$data=cache('data_'.$page);
        $page=request()->page?:1;
        //echo 'brand_'.$page.'_'.$word;
        //$data=Cache::get('brand_'.$page.'_'.$word);//获取
        $data=Redis::get('brand_'.$page.'_'.$word);
        //dump($data);
        if(!$data){
            echo "走db";
        $where=[];
        if($word){
            $where[]=['brand_name','like',"%$word%"];
        }
        //$data=Db::table('brand')->paginate(2);//查询语句  get
        $data=Brand::where($where)->paginate(2);
        //cache(['data_'.$page=>$data],20);
        //Cache::put('brand_'.$page.'_'.$word,$data,60);//存储
        Redis::setex('brand_'.$page.'_'.$word,20,$data);
    }
        if(request()->ajax()){
            return view('admin.brand.ajaxindex',['data'=>$data]);
        }
        return view('admin.brand.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *添加
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //表单验证
        $validatedData=$request->validate([
             'brand_name' => 'required|unique:brand|max:255',
             //'author.description' => 'required',
        ],
        [
                'brand_name.required' => '品牌名称必填',
                'brand_name.unique' => '品牌名称已存在',
            ]);

        $post=$request->except('_token');//except  排除谁  only  接受谁   ['name','age'] 
        //文件上传
        if($request->hasFile('brand_logo')){
            $post['brand_logo']=$this->upload('brand_logo');
        }
        //添加时间
        $post['addtime']=time();
        $res=Brand::insert($post);
        if($res){
            return redirect('/brand');
        }
    }
    //单个文件上传
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
     *展示
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *修改
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $data=Brand::find($id);
       return view('admin.brand.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *执行修改
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post=$request->except('_token');
        $res=Brand::where('brand_id','=',$id)->update($post);
        if($res!==false){
            return redirect('/brand');  //redirect  跳转
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=Db::table('brand')->where('brand_id','=',$id)->delete();
        if($res){
            if(request()->ajax()){
                echo json_encode(['code'=>00000,'msg'=>'删除成功']);die;
            }
            return redirect('/brand');
        }
    }
    public function checkOnly(){
        $brand_name=request()->brand_name;
        $where=[];
        if($brand_name){
            $where['brand_name']=$brand_name;
        }
        $count=Brand::where($where)->count();
        echo intval($count);
    }
}
