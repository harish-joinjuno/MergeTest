<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ShareViaEmailRequest
 * @package App\Http\Requests
 * @property-read array $emails
 */
class ShareViaEmailRequest extends FormRequest
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
            'emails'   => 'required|array',
            'emails.*' => 'email',
        ];
    }

    public function messages()
    {
        return [
            'emails.*' => 'Provided email should be valid email address',
        ];
    }
}
