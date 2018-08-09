<?php

namespace Modules\Oldcpsk\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateStudentRequest extends BaseFormRequest
{
    public function rules()
    {
        return ['total' => 'required'];
    }

    public function translationRules()
    {
        return [];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }

    public function translationMessages()
    {
        return [];
    }
}
