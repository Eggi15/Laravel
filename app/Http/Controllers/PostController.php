<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index()
    {
    	$posts = Post::all();
    	//$users = User::all();
    	return view('posts.index',compact(['posts']));
    }

    public function add()
    {
    	return view('posts.add');
    }

    public function create(Request $request)
    {
    	$post = Post::create([
    		'title' => $request->title,
    		'content' => $request->content,
    		'user_id' => auth()->user()->id,
    		'thumbnail' => $request->thumbnail,
    	]);
    	//dd($request->all());

    	return redirect()->route('post.index')->with('sukses','Data Berhasil Disubmit');
    }

    public function destroy(Posts $post)
    {
    	$post->delete();
    	return redirect()->route('post.index')->with('sukses','Data Berhasil Di hapus');
    }
}
