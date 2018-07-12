<?php

namespace App\Http\Requests\Customer\Bookshelf;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\DataExists;
use UserInfo;

class SetTopForm extends FormRequest
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
            'bookshelf_id'=>array(
                'bail',
                'required',
                'integer',
                new DataExists('bookshelf','\App\Models\Bookshelf','不存在该收藏',true,function($query,$value){
                    $user=UserInfo::getCustomer();
                    $query->where('id',$value)
                            ->where('status',1)
                            ->where('customer_id',$user->id);
                }),
            ),
        ];
    }

    public function  messages(){
        return [
            'bookshelf_id.*'=>'不存在该收藏',
        ];
    }
}
