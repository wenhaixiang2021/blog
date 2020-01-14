<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css"> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<h2>分类添加</h2>
<body>
<form class="form-horizontal" role="form" action="{{url('/cate/store/')}}" method="post">
@csrf
<div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">分类名称</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="firstname" name="cate_name" placeholder="请输入名字">
    </div>
  </div>
  <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">父极分类</label>
    <div class="col-sm-10">
        <select name="parent_id">
            <option value="0">--请选择父极分类--</option>
        @foreach($data as $v)
            <option value="{{$v->cate_id}}">{{str_repeat('--|',$v->level)}}{{$v->cate_name}}</option>
        @endforeach
        </select>
    </div>
  </div>
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">是否显示</label>
    <div class="col-sm-10">
      <input type="radio" value="1" name="is_show">显示
      <input type="radio" value="2" name="is_show">不显示
    </div>
  </div>
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">是否导航栏显示</label>
    <div class="col-sm-10">
      <input type="radio" value="1" name="is_nav_show">显示
      <input type="radio" value="2" name="is_nav_show">不显示
    </div>
  </div>
  
 
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">添加</button>
    </div>
  </div>
</form>
</body>
</html>