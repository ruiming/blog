<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PostCreateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'contents' => 'required',
        ];
    }
    public function postFillData()
    {
        return [
            'title' => $this->title,
            'content' => $this->contents,
            'is_draft' => (bool)$this->is_draft,
            'archive' => $this->archive,
            'author' => config('blog.author'),
        ];
    }
}
