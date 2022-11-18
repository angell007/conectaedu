<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ElementStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:elements,name' . $this->id,
            'reference' => 'string|min:2|unique:elements,reference' . $this->id,
        ];
    }
}
