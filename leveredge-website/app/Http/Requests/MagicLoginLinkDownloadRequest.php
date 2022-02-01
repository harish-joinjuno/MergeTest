<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class MagicLoginLinkDownloadRequest
 * @package App\Http\Requests
 *
 * @property-read int $magic_login_link_id
 */
class MagicLoginLinkDownloadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'magic_login_link_id' => 'required|exists:magic_login_links,id',
        ];
    }
}
