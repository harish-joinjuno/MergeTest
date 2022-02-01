<?php


namespace App\Http\Requests\Admin;


use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $contract_name
 */
class ContractTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|string|unique:contract_types,type',
        ];
    }
}
