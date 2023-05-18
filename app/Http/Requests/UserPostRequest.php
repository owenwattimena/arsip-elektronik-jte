<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nama_lengkap' => 'required',
            'nip' => 'unique:dosen_plp,nip',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'email' => 'required|unique:dosen_plp,email',
            'foto' => 'required|file',
            'password' => 'required',
            'password_confirmation' => 'required_with:password|same:password',
            'status' => 'required',
        ];
    }
}
