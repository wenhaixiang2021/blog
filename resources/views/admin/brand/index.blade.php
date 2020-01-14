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
<h2>品牌列表</h2>
<span>欢迎【{{session('admin')->username?? ''}}】登录<a href="{{url('/logout')}}">退出</a></span><br>
<a href="{{url('/brand/create')}}">添加</a><br>
<form>
    <input type="text" name="brand_name" placeholder="请输入关键字">
    <button class="btn btn-info">搜索</button>
</form>
  <thead>
    <tr>
      <th>品牌ID</th>
      <th>品牌名称</th>
      <th>网址</th>
      <th>描述</th>
      <th>添加时间</th>
      <th>操作</th>
    </tr>
  </thead>
  <tbody>
  @foreach($data as $v)
    <tr>
      <td>{{$v->brand_id}}</td>
      <td><img src="{{env('UPLOAD_URL')}}{{$v->brand_logo}}"width="100" height="100"/>{{$v->brand_name}}</td>
      <td>{{$v->brand_url}}</td>
      <td>{{$v->brand_desc}}</td>
      <td>{{date('Y-m-d H:i:s',$v->addtime)}}</td>
      <td>
      <a onclick="ajaxdel({{$v->brand_id}})" href="javascript:void(0)" class="btn btn-danger">删除</a>
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
                url: "/brand/destroy/"+id,
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