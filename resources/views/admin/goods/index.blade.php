<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">  
</head>
<script src="/static/admin/js/jquery-3.2.1.min.js"></script>
<body>
<table class="table table-condensed">
<h2>商品列表</h2>
<span>欢迎【{{session('admin')->username?? ''}}】登录<a href="{{url('/logout')}}">退出</a></span><br>
<a href="{{url('/goods/create')}}">添加</a><br>
<form>
    <input type="text" name="word" value="{{$query['word']??''}}" placeholder="请输入关键字">
    <input type="text" name="desc" value="{{$query['desc']??''}}" placeholder="请输入关键字">
    <button class="btn btn-info">搜索</button>
</form>
  <thead>
    <tr>
      <th>商品ID</th>
      <th>商品名称</th>
      <th>货号</th>
      <th>品牌名称</th>
      <th>分类名称</th>
      <th>图片</th>
      <th>相册列表</th>
      <th>价格</th>
      <th>描述</th>
      <th>添加时间</th>
      <th>操作</th>
    </tr>
  </thead>
  <tbody>
  @foreach($data as $v)
    <tr>
      <td>{{$v->goods_id}}</td>
      <td>{{$v->goods_name}}</td>
      <td>{{$v->goods_sn}}</td>
      <td>{{$v->brand_name}}</td>
      <td>{{$v->cate_name}}</td>
      <td><img src="{{env('UPLOADS_URL')}}{{$v->goods_file}}"width=100 height=100 alt=""></td>
      <td>
        @if($v->goods_files)
        @foreach($v->goods_files as $vv)
           <img src="{{env('UPLOADS_URL')}}{{$vv}}" width=100 height=100 alt="">
        @endforeach
        @endif
      </td>
      <td>{{$v->goods_price}}</td>
      <td>{{$v->goods_desc}}</td>
      <td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
      <td>
      <a href="{{url('goods/show/'.$v->goods_id)}}" class="btn btn-warning">预览</a>
      <a onclick="ajaxdel({{$v->goods_id}})" href="javascript:void(0)" class="btn btn-danger">删除</a>
      <a href="{{url('brand/edit/'.$v->brand_id)}}" class="btn btn-warning">修改</a>
      </td>
      
     
    </tr>  
   @endforeach 
   <tr>
        <td colspan="4">{{$data->links()}}</td>
   </tr>
  </tbody>
</table>
</body>
</html>
<!-- ajax分页 -->
<script>
    $(document).on('click','.pagination a',function(){
         var url=$(this).attr('href');
         $.get(url,function(res){
              $('tbody').html(res);
         });
         return false;
    })
</script>
<!-- ajax删除 -->
<script>
 function ajaxdel(id){
      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
           $.ajax({
                method: "POST",
                url: "/goods/destroy/"+id,
                data: '',
                dataType:"json",
              }).done(function( msg ) {
                if(msg.code=='00000'){
                  alert(msg.msg);
                  location.reload();
                }
              });

    }
</script>