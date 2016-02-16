<?php

namespace App\Jobs;

use App\Post;
use Illuminate\Contracts\Bus\SelfHandling;

class PostFormFields extends Job implements SelfHandling
{
    /**
     * The id (if any) of the Post row
     *
     * @var integer
     */
    protected $id;

    /**
     * List of fields and default value for each field
     *
     * @var array
     */
    protected $fieldList = [
        'title' => '',
        'subtitle' => '',
        'content' => '',
        'is_draft' => "0",
        'archive' => '未分类',
    ];

    /**
     * Create a new command instance.
     *
     * @param integer $id
     */
    public function __construct($id = null)
    {
        $this->id = $id;
    }

    /**
     * Execute the command.
     *
     * @return array of fieldnames => values
     */
    public function handle()
    {
        $fields = $this->fieldList;
        if ($this->id) {
            $fields = $this->fieldsFromModel($this->id, $fields);
        }
        foreach ($fields as $fieldName => $fieldValue) {
            $fields[$fieldName] = old($fieldName, $fieldValue);
        }
        return $fields;
    }

    /**
     * Return the field values from the model
     *
     * @param integer $id
     * @param array $fields
     * @return array
     */
    protected function fieldsFromModel($id, array $fields)
    {
        $post = Post::findOrFail($id);
        $fieldNames = array_keys($fields);
        $fields = ['id' => $id];
        foreach ($fieldNames as $field) {
            $fields[$field] = $post->{$field};
        }
        return $fields;
    }
}