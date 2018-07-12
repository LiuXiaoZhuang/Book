<?php

namespace App\Http\Requests\Customer\Novel;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\DataExists;

class NovelListForm extends FormRequest
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
            'novel_type_id'=>array(
                'bail',
                'nullable',
                'integer',
                new DataExists('novel_type','\App\Models\NovelType','小说类型不存在'),
            ),
        ];
    }

    public function  messages(){
        return [
            'novel_type_id.*'=>'小说类型不存在',
        ];
    }
}
