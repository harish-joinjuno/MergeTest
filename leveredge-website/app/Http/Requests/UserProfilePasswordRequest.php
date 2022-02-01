<?php

namespace App\Http\Requests;

use App\Rules\MatchOldPassword;
use Illuminate\Foundation\Http\FormRequest;

class UserProfilePasswordRequest extends FormRequest
{

    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'current_password'     => ['required', new MatchOldPassword],
            'new_password'         => 'required',
            'new_password_confirm' => 'same:new_password|string|min:6'
        ];
    }

    public function persist()
    {
        $this->user()->update(['password' => bcrypt($this->request->get('new_password'))]);
    }
}
