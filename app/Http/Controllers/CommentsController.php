<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;

class CommentsController extends Controller
{
    public function store(CommentRequest $request, Post $post): RedirectResponse
    {
        $post->comments()->create($request->all());
        return redirect()->route('posts.show', ['post' => $post]);
    }
}
