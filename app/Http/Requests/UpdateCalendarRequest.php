<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCalendarRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'holiday_name' => 'nullable|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'holiday_name' => '休日名',
        ];
    }
}
