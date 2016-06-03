<?php

namespace App\Http\Controllers;

use App\Post;
use EndaEditor;
use App\Http\Requests;
class AboutController extends Controller
{

    /**
     * 关于页面
     * todo 显示草稿（目前做简历显示用）
     */
    public function index()
    {
        $post = Post::where('is_draft', '==', 1)->firstOrFail();
        $post->content = EndaEditor::MarkDecode($post->content);
        return view('blog.about', compact('post'));
    }
}