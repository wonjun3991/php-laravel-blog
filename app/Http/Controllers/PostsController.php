<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PostsController extends Controller
{
    public function index(): Factory|View|Application
    {
        $posts = Post::with(['comments'])->get();
        return view('posts.index', ['posts' => $posts]);
    }

    public function create(): Factory|View|Application
    {
        return view('posts.create');
    }

    public function store(PostRequest $request): RedirectResponse
    {
        $post = Post::create($request->validated());
        return redirect()->route('posts.show', ['post' => $post]);
    }

    public function show(Post $post): Factory|View|Application
    {
        return view('posts.show', ['post' => $post]);
    }

    public function edit(Post $post): Factory|View|Application
    {
        return view('posts.edit', ['post' => $post]);
    }

    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        $post->update($request->validated());
        return redirect()->route('posts.show', ['post' => $post]);
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();
        return redirect()->route('posts.index');
    }
}
