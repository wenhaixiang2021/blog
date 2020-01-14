
    @foreach($data as $v)
        <tr>
            <td>{{$v->new_id}}</td>
            <td>{{$v->new_name}}</td>
            <td>{{$v->new_writer}}</td>
            <td>{{$v->new_time}}</td>
        </tr>
    @endforeach
    
        {{$data->links()}}
 
 
   
