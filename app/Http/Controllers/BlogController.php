<?php

namespace App\Http\Controllers;

use App\Post;
use EndaEditor;
use App\Http\Requests;
use Redis;
class BlogController extends Controller
{
    public function main()
    {
        $redis=Redis::connection();
        $posts=Post::where('is_draft','==',0)
            ->orderBy('created_at','desc')
            ->paginate(config('blog.posts_per_page'));
        foreach($posts as $post)
        {
            $post->content=EndaEditor::MarkDecode($post->content);
            if($redis->exists('post'.$post->id))
            {
                $post->read=$redis->get('post'.$post->id);
            }
            else $post->read=0;
        }
        return view('blog.index',compact('posts'));
    }

    public function showPost($id)
    {
        $post=Post::whereId($id)->where('is_draft','==',0)->firstOrFail();
        $post->content=EndaEditor::MarkDecode($post->content);
        $redis=Redis::connection();
        if($redis->exists('post'.$id))
        {
            $read=$redis->get('post'.$id);
            $read++;
            $redis->set('post'.$id,$read);
        }
        else  $redis->set('post'.$id,1);
        return view('blog.post')->withPost($post);
    }
}
