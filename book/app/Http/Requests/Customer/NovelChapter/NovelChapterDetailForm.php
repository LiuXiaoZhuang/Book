<?php

namespace App\Http\Requests\Customer\NovelChapter;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\DataExists;

class NovelChapterDetailForm extends FormRequest
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
            'novel_chapter_id'=>array(
                'bail',
                'required',
                'integer',
                new DataExists('novel_chapter','\App\Models\NovelChapter','该章节不存在'),
            ),
        ];
    }

    public function  messages(){
        return [
            'novel_chapter_id.*'=>'该章节不存在',
        ];
    }
}
