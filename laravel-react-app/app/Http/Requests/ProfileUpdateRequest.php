<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Můžeš upravit podle potřeby, aby se validace spustila jen pro autentizované uživatele
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->user()->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'], // Heslo je volitelné, ale pokud je zadáno, musí být potvrzeno
        ];
    }
}
