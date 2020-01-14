<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="/static/admin/js/jquery-3.2.1.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$goods->goods_name}}</title>
</head>

<body>

    <h3>{{$goods->goods_name}}</h3>
    <span>访问量{{$current}}</span>
    <hr>
    <p>价格{{$goods->goods_price}}</p>
    <p>{{$goods->goods_desc}}</p>
    <button class="btn btn-warning">加入购物车</button>
</body>
</html>

<script>
        $('button').click(function(){
            var goods_id={{$goods->goods_id}};
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.post('/goods/addcart',{goods_id:goods_id},function(res){
               if(res.code==00001){
                    alert(res.msg);
                    location.href='/dl/create';
               }
               if(res.code==00001){
                    alert(res.msg);
                    location.href='/dl/create';
               }
               if(res.code==00000){
                    alert(res.msg);
                    location.href='/cart';
               }
            },'json');
        });
        
</script>