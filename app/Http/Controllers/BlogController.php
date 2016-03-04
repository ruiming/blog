<?php

namespace App\Http\Controllers;

use App\Post;
use EndaEditor;
use App\Http\Requests;
class BlogController extends Controller
{

    /**
     * 博客首页
     *
     */
    public function main()
    {
        $posts = Post::where('is_draft', '==', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(config('blog.posts_per_page'));
        foreach($posts as $post) {
            $post->content = EndaEditor::MarkDecode($post->content);
            $post->content = preg_replace('(<a)', '<a target="_blank"', $post->content);
        }
        return view('blog.index', compact('posts'));
    }

    /**
     * 显示具体文章页面,阅读次数加1
     *
     * @param int $id 文章id
     */
    public function showPost($id)
    {
        $post = Post::whereId($id)->where('is_draft', '==', 0)->firstOrFail();
        $post->content = EndaEditor::MarkDecode($post->content);
        $read = Post::whereId($id)->first()->read;
        $time = Post::whereId($id)->first()->updated_at;
        $read ++;
        Post::whereId($id)->update(['read' => $read, 'updated_at' => $time]);
        return view('blog.post')->withPost($post);
    }
}
