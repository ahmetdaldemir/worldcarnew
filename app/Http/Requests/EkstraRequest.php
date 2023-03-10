<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EkstraRequest extends FormRequest
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
            'title' => 'required|max:255',
            'info' => 'required',
            'slug' => 'required|max:255',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'İsim alanı boş olamaz!',
            'info.required'  => 'Bilgilendirme boş olamaz',
            'slug.required'  => 'Seo Link Mecburidir'
        ];
    }
}
