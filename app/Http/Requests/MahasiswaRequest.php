<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MahasiswaRequest extends FormRequest
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
            'nama' => 'required',
            'gender' => 'required',
            'alamat' => 'required',
            'notlp' => ['required', 'regex:/^(\+62|62|0)8[1-9][0-9]{6,9}$/'],
            'jurusan' => 'required|exists:jurusan,id',
            'ttl' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg',
        ];
    }
}
