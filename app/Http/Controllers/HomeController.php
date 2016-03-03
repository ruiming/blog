<?php

namespace App\Http\Controllers;
use App\Post;
use App\Http\Requests;
use EndaEditor;
class HomeController extends Controller
{

    /**
     * admin主页显示
     *
     */
    public function index()
    {
        $posts = Post::where('is_draft', '==', 0)->orderBy('updated_at', 'desc')->take(5)->get();
        $times = array();
        foreach($posts as $key => $post) {
            $timediff = time()-strtotime($post->updated_at);
            $days = intval($timediff/86400);
            $remain = $timediff%86400;
            $hours = intval($remain/3600);
            $remain = $remain%3600;
            $mins = intval($remain/60);
            if($days > 0) $times[$key] = $days."天前";
            else if($days == 0 && $hours > 0) $times[$key] = $hours."小时前";
            else if($hours == 0 && $mins > 0) $times[$key] = $mins."分钟前";
            else if($mins <= 0)   $times[$key] = "1分钟前";
            $post->content = EndaEditor::MarkDecode($post->content);
        }
        return view('home')->withPosts($posts)->withTimes($times);
    }
}
