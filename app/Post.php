<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'title', 'subtitle', 'content','is_draft','archive','author','read'
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        if (! $this->exists) {
            $this->attributes['slug'] = str_slug($value);
        }
    }
}
