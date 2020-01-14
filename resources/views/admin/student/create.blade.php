<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{url('/student/store')}}" method="get">
    @csrf
          学生姓名<input type="text" name="student_name"><br>
          学生性别<input type="text"  name="student_sex"><br>
          学生班级<input type="text" name="student_class"><br>
          <button>添加</button>
    </form>
</body>
</html>