<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<h3>登录</h3>
<body>
<b style="color:red">{{session('msg')}}</b>
    <form action="{{url('/dl/store/')}}" method="post">
    @csrf
        用户名<input type="text" name="username"><br>
        密码<input type="password" name="pwd"><br>
        <button>登录</button>
    </form>
</body>
</html>