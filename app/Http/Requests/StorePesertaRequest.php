<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePesertaRequest extends FormRequest
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
            'nama'     =>  'required',
            'nis'     =>  'required|unique:peserta,nis',
            'nohp'    =>  'numeric',
            'email'    =>  'required',
            'latarbelakang'    =>  'required',
            'tanggalpelaksanaan'    =>  'required'
        ];
    }
}
