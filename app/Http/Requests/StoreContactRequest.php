<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'addr_first_name' => 'required|max:50',
            'addr_last_name' => 'required|max:50',
            // 'addr_city' => 'required|max:50',
            // 'addr_region' => 'required|max:50',
            'addr_email_1' => 'nullable|email|max:128',
            'addr_email_2' => 'nullable|email|max:128',
            'addr_phone_1' => 'nullable|regex:/^\s*(?:\+?(\d{1,3}))?([-. (]*(\d{3})[-. )]*)?((\d{3})[-. ]*(\d{2,4})(?:[-.x ]*(\d+))?)\s*$/m|max:254',
            'addr_phone_2' => 'nullable|regex:/^\s*(?:\+?(\d{1,3}))?([-. (]*(\d{3})[-. )]*)?((\d{3})[-. ]*(\d{2,4})(?:[-.x ]*(\d+))?)\s*$/m|max:254'
        ];
    }
}
