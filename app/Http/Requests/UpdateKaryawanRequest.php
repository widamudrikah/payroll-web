<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKaryawanRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:100',
            'email'       => 'required|email|max:100',
            'password'    => 'nullable|min:8',
            'jabatan'     => 'required|string|max:100',
            'gaji_pokok'  => 'required|numeric|min:0'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'       => 'Nama wajib diisi.',
            'email.required'      => 'Email wajib diisi.',
            'email.email'         => 'Format email tidak valid.',
            'password.min'        => 'Password minimal 8 karakter.',
            'jabatan.required'    => 'Jabatan tidak boleh kosong.',
            'gaji_pokok.required' => 'Gaji pokok harus diisi.',
            'gaji_pokok.numeric'  => 'Gaji pokok harus berupa angka.',
        ];
    }
}
