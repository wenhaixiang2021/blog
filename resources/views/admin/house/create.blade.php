<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<h3>售楼添加</h3>
<body>
    <form action="{{url('house/store/')}}" method="post" enctype="multipart/form-data">
    @csrf
         小区名<input type="text" name="house_name"><br>
         地理位置<input type="text"  name="house_where"><br>
         面积<input type="number"  name="house_big"><br>
         导购员<input type="text"  name="houser"><br>
         联系电话<input type="number"  name="house_number"><br>
         楼盘主图<input type="file"  name="house_file"><br>
         <button>添加</button>
    </form>
</body>
</html>