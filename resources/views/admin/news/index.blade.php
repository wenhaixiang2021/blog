<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="/static/admin/js/jquery-3.2.1.min.js"></script>
</head>
<body>
<form action=""> 
<input type="text" name="new_name">
<button>搜索</button>
</form>
    <table border="1">
        <tr>
            <td>新闻ID</td>
            <td>新闻标题</td>
            <td>新闻作者</td>
            <td>添加时间</td>
        </tr>
    @foreach($data as $v)
        <tr>
            <td>{{$v->new_id}}</td>
            <td>{{$v->new_name}}</td>
            <td>{{$v->new_writer}}</td>
            <td>{{$v->new_time}}</td>
        </tr>
    @endforeach
    {{$data->links()}}
    </table>
  
</body>
</html>
<script>
    $(document).on('click','.pagination a',function(){
         var url=$(this).attr('href');
         $.get(url,function(res){
              $('tbody').html(res);
         });
         return false;
    })
</script>