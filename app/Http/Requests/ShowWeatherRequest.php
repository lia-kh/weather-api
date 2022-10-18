<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\City;

class ShowWeatherRequest extends FormRequest
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
            'name' => ['exists:cities,name','required_without:lat','required_without:lon', 'string', 'min:2', 'max:255'],
            'lat'=>['required_without:name','numeric','between:0,99.9999'],
            'lon'=>['required_without:name','numeric','between:0,99.9999'],
        ];
    }
}
