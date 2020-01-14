<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Goods;
use App\Brand;
use App\Cate;
use App\Cart;
use App\Mail\SendCode;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
class GoodsController extends Controller
{
    public function sendemail()
    {
        Mail::to('2028488746@qq.com')->send(new SendCode());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    public function index()
    {
        $pagesize=config('app.pagesize');
        
        $data=Goods::select('goods.*','brand.brand_name','category.cate_name')
             ->leftJoin('brand','brand.brand_id','=','goods.brand_id')
             ->leftJoin('category','category.cate_id','=','goods.cate_id')
             ->orderBy('goods_id','desc')
             ->paginate($pagesize);
        //dd($data);
        foreach($data as $v){
            if($v->goods_files){
                $v->goods_files=explode('|',$v->goods_files);
            }
        }
        //dd($data);
        if(request()->ajax()){
            return view('admin.goods.ajaxindex',['data'=>$data]);
        }
            return view('admin.goods.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //获取品牌数据
        $brand=Brand::get();
        $cate=Cate::get();
        $cateInfo=createTree($cate);
        //dd($brand);
       return view('admin.goods.create',['brand'=>$brand,'cateInfo'=>$cateInfo]);
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
        //dd($post);
        if($request->hasFile('goods_file')) { 
            $post['goods_file']=upload('goods_file');//调用公共文件里的方法
         }
         //dd($post);
         //多文件上传
         if(isset($post['goods_files'])){
            $post['goods_files']=moreuploads('goods_files');
            $post['goods_files']=implode('|', $post['goods_files']);
         }
         //dd($post);
         $post['add_time']=time();
         $post['update_time']=time();
        $res=Goods::insert($post);
        //dd($res);   true 或  false
        if($res){
            return redirect('/goods');
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
        //访问量
        //Redis::flushAll();
        $res=Redis::setnx('show_'.$id,1);// 之前没有访问过  初始化1
        if(!$res){
            Redis::incr('show_'.$id);
        }
        $current=Redis::get('show_'.$id);

        $goods=Goods::find($id);
        return view('admin.goods.show',['goods'=>$goods,'current'=>$current]);
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
        $res=Goods::where('goods_id','=',$id)->delete();
        if($res){
            if(request()->ajax()){
                echo json_encode(['code'=>00000,'msg'=>'删除成功']);die;
            }
            return redirect('/goods');
        }
    }
    //加入购物车
    public function addcart(){
        $goods_id=request()->goods_id;
        $buy_number=1;
        //判断用户是否登录
        if(!$this->isLogin()){
            //echo json_encode(['code'=>'00001','msg'=>'未登录,请登录']);die;
            //未登录存入cookie
        }
            //登录存入db
            $this->addDBcart($goods_id,$buy_number);

}
    public function addDBcart($goods_id,$buy_number){
        
        //求商品的信息
        $goods=Goods::where('goods_id','=',$goods_id)->first();
        //判断库存
        if($goods->goods_number<$buy_number){
            echo json_encode(['code'=>'00002','msg'=>'库存不足']);die;
        }
        $user_id=session('admin')['admin_id'];
        //判断用户是否之前买过
        $cart=Cart::where(['goods_id'=>$goods_id,'user_id'=>$user_id])->first();
        if($cart){
            //更新购买数量
            //判断库存
                if($cart->buy_number+$buy_number>$goods->goods_number){
                    echo json_encode(['code'=>'00002','msg'=>'库存不足']);die;
                }
            $res=Cart::where(['goods_id'=>$goods_id,'user_id'=>$user_id])->increment('buy_number'); 
            if($res){
                echo json_encode(['code'=>'00000','msg'=>'加入购物车成功']);die;
            }
        }
        
        //没有购买  则正常添加数据
        //求价格
        $goods_price=Goods::where('goods_id','=',$goods_id)->value('goods_price');
        //dd($goods_price);
        $data=[
            'user_id'=>$user_id,
            'goods_id'=>$goods_id,
            'buy_number'=>1,
            'goods_price'=>$goods->goods_price,
            'add_time'=>time(),
        ];
        $res=Cart::insert($data);
        if($res){
            echo json_encode(['code'=>'00000','msg'=>'加入购物车成功']);die;
        }
    }

        public function isLogin(){
                $user=session('admin');
                if(!$user){
                    return false;
                }
                    return true;
        }
}