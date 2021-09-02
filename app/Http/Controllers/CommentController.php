<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Post $post)
    {
        $post->comments()->create($request->validated());
        return redirect()->route('posts.show', ['post' => $post]);
    }
}
