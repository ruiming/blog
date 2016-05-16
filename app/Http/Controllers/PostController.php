<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Post;
use App\Archive;
use App\Jobs\PostFormFields;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use EndaEditor;
class PostController extends Controller
{

    /**
     * markdown上传文件
     *
     */
    public function upload()
    {
        $data = EndaEditor::uploadImgFile('uploads');
        return json_encode($data);
    }

    /**
     * admin文章管理页面显示文章列表
     *
     */
    public function index()
    {
        $posts = Post::where('is_draft', '==', 0)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.post.index')->withPosts($posts);
    }

    /**
     * admin文章创建表单
     *
     */
    public function create()
    {
        $archives = Archive::orderBy('created_at', 'desc')->get()->toArray();
        $data = $this->dispatch(new PostFormFields());
        return view('admin.post.create')->with($data)->withArchives($archives);
    }

    /**
     * 存储文章到数据库
     *
     * @param PostCreateRequest $request
     */
    public function store(PostCreateRequest $request)
    {
        $post = Post::create($request->postFillData());
        $counts = Archive::where('name', '=', $request->archive)->first()->counts;
        $archive = Archive::where('name', '=', $request->archive)->update(['counts' => $counts+1]);
        return redirect()->route('admin.post.index')->withSuccess('New Post Successfully Created.');
    }

    /**
     * 显示文章编辑表单
     *
     * @param int $id
     */
    public function edit($id)
    {
        $archives = Archive::orderBy('created_at', 'desc')->get()->toArray();
        $data = $this->dispatch(new PostFormFields($id));
        return view('admin.post.edit')->with($data)->withArchives($archives);
    }

    /**
     * 更新文章
     *
     * @param PostUpdateRequest $request 文章更新表单
     * @param int $id 文章id
     */
    public function update(PostUpdateRequest $request,  $id)
    {
        $post = Post::findOrFail($id);
        $check = $post->archive;
        $post->fill($request->postFillData());
        $post->save();
        if($request->archive != $check)
        {
            $counts = Archive::where('name', '=', $check)->first()->counts;
            $archive = Archive::where('name', '=', $check)->update(['counts' => $counts-1]);
            $counts = Archive::where('name', '=', $request->archive)->first()->counts;
            $archive = Archive::where('name', '=', $request->archive)->update(['counts' => $counts+1]);
        }
        return redirect()->route('admin.post.index')->withSuccess('Post saved.');
    }

    /**
     * 删除文章
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('admin.post.index')->withSuccess('Post deleted.');
    }
}
