<?php

namespace App\Http\Controllers;

use App\Post;
use EndaEditor;
use App\Http\Requests;
class AboutController extends Controller
{

    /**
     * 博客首页
     * todo 草稿替代简历
     */
    public function index()
    {
        $post = Post::where('is_draft', '==', 1)
            ->firstOrFail();
        $post->content = EndaEditor::MarkDecode($post->content);
        return view('blog.about', compact('post'));
    }
}