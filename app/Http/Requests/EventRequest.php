<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
        $rules= [
            'title'                 =>'required|unique:events',
            'description'           =>'required',
            'image'                 =>'required|mimes:jpeg,bmp,png,jpg',
        ];
        switch($this->method()){
            case 'PUT':
            case 'PATCH':
                $rules['title']='required';
                $rules['image']='mimes:jpeg,bmp,png,jpg';
                break;
        }

        return $rules;

    }
}
