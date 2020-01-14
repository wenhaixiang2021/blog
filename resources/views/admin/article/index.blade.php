<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Document</title>
    <script src="/static/admin/js/jquery-3.2.1.min.js"></script>
</head>
<body>
<form>

<span>欢迎【{{session('admin')->username?? ''}}】登录<a href="{{url('/logouto')}}">退出</a></span><br>
<input type="text" placeholder="请输入关键字" name="article_title">
全部分类
                <select name="article_cate" id="">
                    <option value="0">--请选择--</option>
                    <option value="1">手机促销</option>
                    <option value="2">3G咨询</option>
                </select><br>
<button>搜索</button>
</form>
<a href="/article/create">添加</a>
    <table border="1">
        <tr>
            <td>编号</td>
            <td>文章标题</td>
            <td>文章分类</td>
            <td>文章重要性</td>
            <td>是否显示</td>
            <td>添加日期</td>
            <td>操作</td>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->article_id}}</td>
            <td>{{$v->article_title}}</td>
            <td>{{$v->article_cate==1 ? '手机促销' : '3G咨询'}}</td>
            <td>{{$v->article_importent==1 ? '普通' : '置顶'}}</td>
            <td>{{$v->is_show==1 ? '显示' : '不显示'}}</td>
            <td>{{date('Y-m-d H:i:s',$v->article_time)}}</td>
            <td>
              <a onclick="ajaxdel({{$v->article_id}})" href="javascript:void(0)">删除</a>
              <a href="{{url('/article/edit/'.$v->article_id)}}">修改</a>
            </td>
        </tr>
        @endforeach
        {{$data->links()}}
    </table>
</body>
</html>
<script>
  function ajaxdel(id){
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
            method: "POST",
            url: "/article/destroy/"+id,
            data: '',
            dataType:'json',
            }).done(function( msg ) {
                if(msg.code=='00000'){
                    alert(msg.msg);
                    location.reload();
                }
            });

  }
    
</script>