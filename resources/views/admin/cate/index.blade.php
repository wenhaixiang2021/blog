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
            <td>分类ID</td>
            <td>分类名称</td>
            <td>是否展示</td>
            <td>是否在导航栏中显示</td>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->cate_id}}</td>
            <td>{{str_repeat('--|',$v->level)}}{{$v->cate_name}}</td>
            <td>{{$v->is_show==1 ? '√' : '×'}}</td>
            <td>{{$v->is_nav_show==1 ? '√' : '×'}}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>