<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use app\models\User;
use App\Http\Controllers\RegisterController;
class PostController extends Controller
{
    public function index(Request $request)
    {
        if (!RegisterController::check_authorized($request)) {
            // return response()->json($request->header());
        return redirect()-> route('login');};
        $posts = Post::paginate(10);
        // return response()->json($posts);
        return view('posts', ['posts' => $posts]);
    }
    
    public function store(Request $request)
    {  
        // Return response("ok" ,201);
        if(RegisterController::check_authorized($request)) {
            $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = Post::create([
            "title" => $validatedData['title'],
            'content' => $validatedData['content'],
            "user_id" => User::get_by_email($request->only('email'))->id,
        ]);

        return response()->json([
            'message' => 'Post created successfully',
            'data' => $post
        ], 201);
        };
        return redirect('login');
    }
}