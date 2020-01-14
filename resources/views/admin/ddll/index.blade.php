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
            <td>ID</td>
            <td>用户名</td>
            <td>用户省份</td>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->user_id}}</td>
            <td>{{$v->user_name}}</td>
            <td></td>
        </tr>
        @endforeach
        {{$data->links()}}
    </table>
</body>
</html>