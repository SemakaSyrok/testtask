<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'subject' => [
                'required',
                'string',
                'min:10',
                'max:50'
            ],
            'text' => [
                'required',
                'string',
                'min:10',
                'max:150'
            ],
            'post_id' => [
                'required',
                'numeric',
                'exists:posts,id'
            ]
        ];
    }
}
