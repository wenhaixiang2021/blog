<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<h2>员工添加</h2>
<body>
    <form action="{{url('/number/store')}}" method="post">
    @csrf
        姓名<input type="text" name="number_name"><br>
        部门<input type="text" name="number_class"><br>
        头像<input type="file" name="number_file"><br>
        <button>添加</button>
    </form>
</body>
</html>