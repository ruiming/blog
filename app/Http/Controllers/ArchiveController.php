<?php

namespace App\Http\Controllers;

use App\Archive;
use App\Post;
use App\Http\Requests;
use App\Http\Requests\ArchiveCreateRequest;
use App\Http\Requests\ArchiveUpdateRequest;
use EndaEditor;
use Redis;
class ArchiveController extends Controller
{

    protected $fields = [
        'name' => '',
        'slug' => ''
    ];

    /**
     * 显示全部分类
     *
     */
    public function getArchive()
    {
        $categorys = Archive::orderBy('counts', 'desc')->get()->toarray();
        $times = Post::orderBy('created_at', 'desc')->get()->toarray();
        $j = 0;
        $dates = array([]);
        foreach($times as $time) {
            $year = substr($time['created_at'], 0, 4);
            $month = substr($time['created_at'], 5, 2);
            $date = $year.$month;
            if($j != 0 && $dates[$j-1] != $date) {
                $dates[$j] = $date;
                $j++;
            }
            else if($j == 0) {
                $dates[$j] = $date;
                $j++;
            }
        }
        return view('blog.archives')->withCategorys($categorys)->withDates($dates);
    }

    /**
     * 显示相应的分类页
     *
     * @param String $slug 分类slug
     */
    public function category($slug)
    {
        $archive = Archive::whereSlug($slug)->first()->name;
        $posts = Post::whereArchive($archive)->orderBy('created_at', 'desc')->get();
        foreach($posts as $post) {
            $post->content = EndaEditor::MarkDecode($post->content);
        }
        return view('blog.archive')->withPosts($posts);
    }

    /**
     * 跳转相应的月份归档页
     *
     * @param int $year
     * @param int $month
     */
    public function date($year, $month)
    {
        $time = $year."-".$month;
        $posts = Post::orderBy('created_at')->get();
        $i = 0;
        $result = array([]);
        foreach($posts as $post) {
            if(substr($post["created_at"], 0, 7) == $time) {
                $result[$i] = $post;
                $i++;
            }
            $post->content = EndaEditor::MarkDecode($post->content);
        }
        return view('blog.archive')->withPosts($result);
    }

    /**
     * 分类管理页面首页
     *
     */
    public function index()
    {
        return view('admin.archive.index')->withArchives(Archive::all());
    }

    /**
     * 添加新分类表单
     *
     */
    public function create()
    {
        $data = [];
        foreach($this->fields as $field => $default) {
            $data[$field] = old($field, $default);
        }
        return view('admin.archive.create', $data);
    }

    /**
     * 添加新分类，存入数据库
     *
     * @param ArchiveCreateRequest $request 分类创建request
     */
    public function store(ArchiveCreateRequest $request)
    {
        $archive = new Archive();
        foreach(array_keys($this->fields) as $field) {
            $archive->$field = $request->get($field);
        }
        $archive->save();
        return redirect('/admin/archive')->withSuccess("The archive '$archive->name' was created.");
    }

    /**
     * 编辑分类表单
     *
     * @param int $id 分类id号
     * @return Response
     */
    public function edit($id)
    {
        $archive = Archive::findOrFail($id);
        $data = ['id' => $id];
        foreach(array_keys($this->fields) as $field) {
            $data[$field] = old($field,  $archive->$field);
        }
        return view('admin.archive.edit', $data);
    }

    /**
     * 编辑分类，存入数据库
     *
     * @param ArchiveUpdateRequest $request 分类编辑request
     * @param int $id 分类id
     */
    public function update(ArchiveUpdateRequest $request, $id)
    {
        $archive = Archive::findOrFail($id);
        foreach (array_keys(array_except($this->fields, ['archive'])) as $field) {
            $archive->$field = $request->get($field);
        }
        $archive->save();
        return redirect("/admin/archive/$id/edit")->withSuccess("Changes saved.");
    }

    /**
     * 删除分类
     *
     * @param int $id 分类id
     */
    public function destroy($id)
    {
        $archive = Archive::findOrFail($id);
        $archive->delete();
        return redirect('/admin/archive')->withSuccess("The '$archive->name' archive has been deleted.'");
    }
}
