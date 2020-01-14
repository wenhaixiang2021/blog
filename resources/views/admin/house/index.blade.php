<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>
<script src="/static/admin/js/jquery-3.2.1.min.js"></script>
<a href="{{url('/house/create/')}}">添加</a>
<body>
    <table border="1">
        <tr>
            <td>ID</td>
            <td>小区名</td>
            <td>地理位置</td>
            <td>面积</td>
            <td>导购员</td>
            <td>联系电话</td>
            <td>楼盘主图</td>
            <td>操作</td>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->house_id}}</td>
            <td>{{$v->house_name}}</td>
            <td>{{$v->house_where}}</td>
            <td>{{$v->house_big}}</td>
            <td>{{$v->houser}}</td>
            <td>{{$v->house_number}}</td>
            <td><img src="{{env('UPLOAD_URL')}}{{$v->house_file}}"width="100" height="100"/></td>
            <td>
                <a  onclick="ajaxdel({{$v->house_id}})" href="javascript:void(0)">删除</a>
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
                url: "/house/destroy/"+id,
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