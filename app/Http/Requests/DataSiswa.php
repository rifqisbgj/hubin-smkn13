<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DataSiswa extends FormRequest
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
        $tahun = date('Y');
        return [
            'nis' => 'required|integer|unique:App\Siswa,nis',
            'nama' => 'required|regex:/^[\pL\s]+$/u',
            'jenis_kelamin' => [
                'required',
                Rule::in(['L', 'P']),
            ],
            'jurusan' => [
                'required',
                Rule::in(['AK', 'RPL', 'TKJ']),
            ],
            'kelas' => 'required|integer|gte:1|lte:6',
            'tahun' => "required|integer|gte:2020|lte:{$tahun}",
        ];
    }
}
