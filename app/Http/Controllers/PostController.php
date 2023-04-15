<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // menampilkan semua post
        $posts = Post::latest()->get();

        // kembalikan ke tampilan
        return inertia('Posts/Index', [
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return inertia('Posts/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title',
            'content'
        ]);

        Post::create([
            'title' => $request->title,
            'content' => $request->content
        ]);

        return redirect()->route('posts.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Post $post)
    {
        return inertia('Posts/Edit', [
            'post' => $post
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title',
            'content'
        ]);

        $post->update([
            'title'     => $request->title,
            'content'   => $request->content
        ]);

        return redirect()->route('posts.index')->with('success', 'Data Berhasil Diupdate!');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Data Berhasil Dihapus!');
    }
}
