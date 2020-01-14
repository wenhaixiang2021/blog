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
            <td>学生ID</td>
            <td>学生名称</td>
            <td>学生性别</td>
            <td>学生班级</td>
            <td>操作</td>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->student_id}}</td>
            <td>{{$v->student_name}}</td>
            <td>{{$v->student_sex}}</td>
            <td>{{$v->student_class}}</td>
            <td>
              <a href="{{url('/student/edit/'.$v->student_id)}}">删除</a>
              <a href="{{url('/student/destroy/'.$v->student_id)}}">编辑</a>
            </td>
        </tr>
        @endforeach
          
          {{$data->links()}}
          
            
        
    </table>
</body>
</html>