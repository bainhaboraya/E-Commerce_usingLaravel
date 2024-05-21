<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $rules = [
            'title' => ["required", "min:3",Rule::unique('products', 'title')],
            "details" => ["required", "min:10"],
            'image' => ['image', 'mimes:jpg,png'],
            ];
            if ($this->isMethod('PUT')) {
                $rules['title'][] = Rule::unique('products')->ignore($this->route('product'));
            }
            return $rules;
    }
}