<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<h2>图书添加</h2>
<body>
    <form action="{{url('/book/store')}}" method="post" enctype="multipart/form-data">
    @if ($errors->any()) 
    <div class="alert alert-danger"> 
    <ul>
     @foreach ($errors->all() as $error) 
     <li>{{ $error }}</li>
      @endforeach
</ul> 
</div> 
@endif
    @csrf
          图书名称<input type="text" name="book_name"><br>
          图书价格<input type="number" name="book_price"><br>
          图书封面<input type="file" name="book_file"><br>
          <button>添加</button>
    </form>
</body>
</html>