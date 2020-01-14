<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<h3>文章修改</h3>
<body>
    <form action="{{url('/article/update/'.$data->article_id)}}" method="post">
    @csrf
        文章标题<input type="text" name="article_title" value="{{$data->article_title}}"><br>
        文章分类
                <select name="article_cate" id="">
                    <option value="0">--请选择--</option>
                    <option value="1">手机促销</option>
                    <option value="2">3G咨询</option>
                </select><br>
        文章重要性<input type="radio" name="article_importent" value="1 ? selected : ''">普通
                 <input type="radio" name="article_importent" value="2 ? selected : ''">置顶<br>
        是否显示  <input type="radio" name="is_show" value="1">显示
                 <input type="radio" name="is_show" value="2">不显示<br>
        文章作者<input type="text" name=""><br>
        作者email<input type="text" name=""><br>
        关键字<input type="text" name=""><br>
        网页描述<textarea name="" id="" cols="30" rows="10"></textarea><br>
        上传文件<input type="file"><br>
    <button>修改</button>
    </form>
</body>
</html>