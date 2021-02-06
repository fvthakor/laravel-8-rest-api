<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Validator;
class BlogController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'category'=>'required',
            'description'=>'required'
        ]);
        if ($validator->fails()) {
    		return response()->json($validator->errors(),422);
        }
    	$blog = new Blog;
    	$blog->title = $request->title;
    	$blog->category = $request->category;
    	$blog->description = $request->description;
    	$is_save = $blog->save();
    	if($is_save){
    		$status = 201;
    		$data = array(
    			'message' => 'Blog successfully created',
    			'data' => $blog
    		);
    	}else{
    		$data = array(
    			'message' => 'Blog not created'
    		);
    		$status = 400;
    	}
    	return response()->json($data,$status);
    }

    public function show($id)
    {
        $blog = Blog::find($id);
    	if($blog){
    		$status = 200;
    		$data = array(
    			'message' => 'Blog record',
    			'data' => $blog
    		);
    	}else{
    		$data = array(
    			'message' => 'Record not found'
    		);
    		$status = 400;
    	}
    	return response()->json($data,$status);
    }
    public function update(Request $request,$id)
    {
    	$validator = Validator::make($request->all(), [
            'title' => 'required',
            'category'=>'required',
            'description'=>'required',
        ]);
        if ($validator->fails()) {
    		return response()->json($validator->errors(),422);
        }
    	$blog = Blog::find($id);
    	if($blog){
    		$blog->title = $request->title;
	    	$blog->category = $request->category;
	    	$blog->description = $request->description;
	    	$is_save = $blog->save();
	    	if($is_save){
	    		$status = 201;
	    		$data = array(
	    			'message' => 'Blog successfully update',
	    			'data' => $blog
	    		);
	    	}else{
	    		$data = array(
	    			'message' => 'Blog not update'
	    		);
	    		$status = 400;
	    	}
    	}else{
    		$data = array(
	    			'message' => 'Record not found'
	    		);
	    		$status = 400;
    	}
    	return response()->json($data,$status);
    }

    public function destroy($id)
    {
    	$blog = Blog::find($id);
    	if($blog){
    		$is_delete = $blog->delete();
    		if($is_delete){
    			$data = array(
	    			'message' => 'Blog successfully deleted'
	    		);
	    		$status = 200;
    		}else{
    			$data = array(
	    			'message' => 'Blog not deleted'
	    		);
	    		$status = 400;
    		}
    	}else{
    		$data = array(
    			'message' => 'Record not found'
    		);
    		$status = 400;
    	}
    	return response()->json($data,$status);
    }
}
