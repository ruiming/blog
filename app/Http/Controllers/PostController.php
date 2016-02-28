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
    public function upload()
    {
        $data = EndaEditor::uploadImgFile('uploads');
        return json_encode($data);
    }

    /**
     * Display a listing of the posts.
     */
    public function index()
    {
        $posts=Post::orderBy('created_at','desc')->get();
        return view('admin.post.index')->withPosts($posts);
    }

    /**
     * Show the new post form
     */
    public function create()
    {
        $archives=Archive::orderBy('created_at','desc')->get()->toArray();
        $data = $this->dispatch(new PostFormFields());
        return view('admin.post.create')->with($data)->withArchives($archives);
    }

    /**
     * Store a newly created Post
     *
     * @param PostCreateRequest $request
     */
    public function store(PostCreateRequest $request)
    {
        $post = Post::create($request->postFillData());
        $counts=Archive::where('name','=',$request->archive)->first()->counts;
        $archive=Archive::where('name','=',$request->archive)->update(['counts'=>$counts+1]);
        return redirect()->route('admin.post.index')->withSuccess('New Post Successfully Created.');
    }

    /**
     * Show the post edit form
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $archives=Archive::orderBy('created_at','desc')->get()->toArray();
        $data = $this->dispatch(new PostFormFields($id));
        return view('admin.post.edit')->with($data)->withArchives($archives);
    }

    /**
     * Update the Post
     *
     * @param PostUpdateRequest $request
     * @param int $id
     */
    public function update(PostUpdateRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $check=$post->archive;
        $post->fill($request->postFillData());
        $post->save();
        if($request->archive!=$check)
        {
            $counts=Archive::where('name','=',$check)->first()->counts;
            $archive=Archive::where('name','=',$check)->update(['counts'=>$counts-1]);
            $counts=Archive::where('name','=',$request->archive)->first()->counts;
            $archive=Archive::where('name','=',$request->archive)->update(['counts'=>$counts+1]);
        }
        return redirect()->route('admin.post.index')->withSuccess('Post saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('admin.post.index')->withSuccess('Post deleted.');
    }
}
