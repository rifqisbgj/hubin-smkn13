<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DataIndustri extends FormRequest
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
            'nama' => 'required',
            'bidang' => 'nullable',
            'kontak' => 'nullable',
            'jurusan' => 'required|array|min:1',
            'jurusan.*' => [
                'required',
                'distinct',
                Rule::in(['AK', 'RPL', 'TKJ']),
            ],
            'tahun' => "required|integer|gte:2020|lte:{$tahun}",
            'alamat' => 'required',
            'kuota' => 'required|integer|min:1',
            'nis_pengaju' => 'nullable|required_with:status|integer|exists:App\Siswa,nis',
            'nama_pembimbing' => 'nullable',
            'nip_pembimbing' => 'nullable|integer',
        ];
    }
}
