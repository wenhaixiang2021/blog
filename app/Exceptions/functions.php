<?php
 //公共文件

 //无限极分类
     function createTree($data,$parent_id=0,$level=1){
			static $arr=[];
			if(!$data){
				return;
			}
			foreach($data as $k=>$v){
			    if($v->parent_id==$parent_id){
					$v->level=$level;
					$arr[]=$v;
					createTree($data,$v->cate_id,$level+1);
				}
			}
			return $arr;
	 }



	  function newsTree($data,$parent_id=0,$level=1){
			static $arr=[];
			if(!$data){
				return;
			}
			foreach($data as $k=>$v){
			    if($v->parent_id==$parent_id){
					$v->level=$level;
					$arr[]=$v;
					createTree($data,$v->cate_id,$level+1);
				}
			}
			return $arr;
	 }

//单文件上传
	  function upload($filename){
        if(request()->file($filename)->isValid()) {
            $photo = request()->file($filename);
            $store_result = $photo->store('upload');
            return $store_result;
            }
            exit('未获取到上传文件或上传过程出错');
    }
  //多文件上传
       function moreuploads($filename){
		  if(!$filename){
				return;
		  }
		  $files=request()->file($filename);
		  //dd($files);
		  $result=[];
		  foreach($files as $v){
            $result[] = $v->store('upload');
		  }
		  return $result;
	   }