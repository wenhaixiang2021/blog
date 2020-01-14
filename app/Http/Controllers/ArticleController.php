<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $word=request()->article_title??'';
        $where=[];
        if($word){
            $where[]=['article_title','like',"%$word%"];
        };
        $cate=request()->article_cate??'';
        $where=[];
        if($cate){
            $where[]=['article_cate','=',"$cate"];
        };
        $data=Article::where($where)->paginate(2);
        //dd($data);
       return view('admin.article.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData=$request->validate([
            'article_title' => 'required|unique:article|max:255',
            //'author.description' => 'required',
       ],[
               'article_title.required' => '标题必填',
               'article_title.unique' => '标题名称已存在',
           ]);
        $post=$request->except('_token');
        $article_time=time();
        $res=Article::insert($post);
        if($res){
            return redirect('/article');
        }
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
        $data=Article::find($id);
        return view('admin.article.edit',['data'=>$data]);
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
        $post=$request->except('_token');
        $res=Article::where('article_id','=',$id)->update($post);
        if($res){
            return redirect('/article');
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
        
       $res=Article::where('article_id','=',$id)->delete();
       if($res){
           if(request()->ajax()){
                echo json_encode(['code'=>00000,'msg'=>'删除成功']);die;
           }
            return redirect('/article');
       }
    }
}
