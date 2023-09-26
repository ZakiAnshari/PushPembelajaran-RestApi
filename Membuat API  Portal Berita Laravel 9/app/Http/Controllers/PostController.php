<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostDetailResource;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnSelf;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        // return response()->json(['data' => $posts]);
        return PostResource::collection($posts); //mengembalikan data lebih dari satu
    }

    public function show($id)
    {
        $post = Post::with('writer:id,username')->findOrFail($id);
        return new PostDetailResource($post); //mengembalikan 1 data
    }

    public function show2($id)
    {
        $post = Post::withfindOrFail($id);
        return new PostDetailResource($post); //mengembalikan 1 data
    }

    public function store(Request $request)
    {
    
        $validated = $request->validate([
            'title' => 'required|max:255',
            'news_constent' => 'required',
        ]);
        
        $request['author'] = Auth::user()->id;
        $post = Post::create($request->all());
        return new PostDetailResource($post->loadMissing('writer:id,username'));
    }
}
