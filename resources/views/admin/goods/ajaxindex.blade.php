@foreach($data as $v)
    <tr>
      <td>{{$v->goods_id}}</td>
      <td>{{$v->goods_name}}</td>
      <td>{{$v->goods_sn}}</td>
      <td>{{$v->brand_name}}</td>
      <td>{{$v->cate_name}}</td>
      <td><img src="{{env('UPLOADS_URL')}}{{$v->goods_file}}"width=100 height=100 alt=""></td>
      <td>
        @if($v->goods_files)
        @foreach($v->goods_files as $vv)
           <img src="{{env('UPLOADS_URL')}}{{$vv}}"width=100 height=100 alt="">
        @endforeach
        @endif
      </td>
      <td>{{$v->goods_price}}</td>
      <td>{{$v->goods_desc}}</td>
      <td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
      <td>
      <a href="{{url('goods/show/'.$v->goods_id)}}" class="btn btn-warning">预览</a>
      <a onclick="ajaxdel({{$v->goods_id}})" href="javascript:void(0)" class="btn btn-danger">删除</a>
      <a href="{{url('brand/edit/'.$v->brand_id)}}" class="btn btn-warning">修改</a>
      </td>
      
     
    </tr>  
   @endforeach 
   <tr>
        <td colspan="4">{{$data->links()}}</td>
   </tr>