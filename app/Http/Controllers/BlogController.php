<?php

namespace App\Http\Controllers;

use App\Post;
use EndaEditor;
use App\Http\Requests;
class BlogController extends Controller
{
    public function main()
    {
        $posts=Post::where('is_draft','==',0)
            ->orderBy('created_at','desc')
            ->paginate(config('blog.posts_per_page'));
        foreach($posts as $post)
        {
            $post->content=EndaEditor::MarkDecode($post->content);
        }
        return view('blog.index',compact('posts'));
    }

    public function showPost($id)
    {
        $post=Post::whereId($id)->where('is_draft','==',0)->firstOrFail();
        $post->content=EndaEditor::MarkDecode($post->content);
        $read = Post::whereId($id)->first()->read;
        $read ++;
        Post::whereId($id)->update(['read' => $read]);
        return view('blog.post')->withPost($post);
    }
}
