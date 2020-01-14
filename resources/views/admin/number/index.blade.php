<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <tr>
            <td>员工号</td>
            <td>员工名称</td>
            <td>员工部门</td>
            <td>员工头像</td>
            <td>操作</td>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->number_id}}</td>
            <td>{{$v->number_name}}</td>
            <td>{{$v->number_class}}</td>
            <td></td>
            <td>
               <a href="{{url('/number/destroy/'.$v->number_id)}}">删除</a>
               <a href="{{url('/number/edit/'.$v->number_id)}}">修改</a>
            </td>
        </tr>
        @endforeach
        {{$data->links()}}
    </table>
</body>
</html>