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
            <td>图书名称</td>
            <td>图书价格</td>
            <td>图书封面</td>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->book_id}}</td>
            <td>{{$v->book_name}}</td>
            <td>{{$v->book_price}}</td>
            <td><img src="{{env('UPLOADS_URL')}}{{$v->book_file}}" width="100" height="100" alt=""></td>
        </tr>
        @endforeach
        {{$data->links()}}
    </table>
</body>
</html>