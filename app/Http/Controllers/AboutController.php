<?php

namespace App\Http\Controllers;

use App\Post;
use EndaEditor;
use App\Http\Requests;
class AboutController extends Controller
{

    /**
     * 博客首页
     * 11 是简历的ID
     */
    public function index()
    {
        $post = Post::whereId(11)->firstOrFail();
        $post->content = EndaEditor::MarkDecode($post->content);
        return view('blog.about', compact('post'));
    }
}