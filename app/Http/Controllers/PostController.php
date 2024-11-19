<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index() {
        // postsテーブルからすべてのデータを取得し、変数$postsに代入する
        $posts = DB::table('posts')->get();
 
        // 変数$postsをposts/index.blade.phpファイルに渡す
        return view('posts.index', compact('posts'));
    }   
    
    public function show($id) {
        $post = Post::find($id);
 
        return view('posts.show', compact('post'));

    }

    public function create() {
        return view('posts.create');
    }

    public function store(Request $request) {
       $request->validate([
         'title' => 'required|max:20',
         'content' => 'required|max:200'
       ]);

       $post = new Post();
       $post->title = $request->input('title');
       $post->content = $request->input('content');
       $post->save();

       return redirect("/posts");
    }
    }

