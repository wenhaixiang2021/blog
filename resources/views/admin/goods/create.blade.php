<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css"> 
    <script src="/static/admin/js/jquery-3.2.1.min.js"></script>
    <script src="/static/admin/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>

<h2>商品添加</h2>
<body>
<form class="form-horizontal" role="form" action="{{url('/goods/store')}}" method="post" enctype="multipart/form-data">

<ul id="myTab" class="nav nav-tabs">
	<li class="active">
		<a href="#home" data-toggle="tab">
			 基础信息
		</a>
	</li>
	<li><a href="#ios" data-toggle="tab">商品相册</a></li>
  <li><a href="#desc" data-toggle="tab">商品详情</a></li>
</ul>
<div id="myTabContent" class="tab-content">
	<div class="tab-pane fade in active" id="home">
		<p>
    <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">商品名称</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="firstname" name="goods_name" placeholder="请输入名字">
    </div>
  </div>
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">商品货号</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" id="lastname" name="goods_sn">
    </div>
  </div>
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">商品品牌</label>
    <div class="col-sm-10">
      <select name="brand_id" id="" class="form-control">
          <option value="">请选择商品品牌</option>
        @foreach($brand as $v)
          <option value="{{$v->brand_id}}">{{str_repeat('--|',$v->level)}}{{$v->brand_name}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">商品分类</label>
    <div class="col-sm-10">
    <select name="cate_id" id="" class="form-control">
          <option value="">请选择商品分类</option>
          @foreach($cateInfo as $v)
          <option value="{{$v->cate_id}}">{{str_repeat('--|',$v->level)}}{{$v->cate_name}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">商品缩略图</label>
    <div class="col-sm-10">
      <input type="file" class="form-control" id="lastname" name="goods_file" placeholder="请输入姓">
    </div>
  </div>
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">商品价格</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" id="lastname" name="goods_price">
    </div>
  </div>
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">商品库存</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" id="lastname" name="goods_number">
    </div>
  </div>
    </p>
	</div>
	<div class="tab-pane fade" id="ios">
		<p>
    <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">商品相册</label>
    <div class="col-sm-10">
      <input type="file"  multiple="multiple" class="form-control" id="lastname" name="goods_files[]" placeholder="请输入姓">
    </div>
  </div>
    </p>
	</div>
	<div class="tab-pane fade" id="desc">
		<p>
    <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">商品详情</label>
    <div class="col-sm-10">
      <textarea type="text" class="form-control" id="lastname" name="goods_desc" placeholder="请输入姓"></textarea>
    </div>
  </div>
    </p>
	</div>
	
</div>
@csrf
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">商品添加</button>
    </div>
  </div>
</form>
</body>
</html>
