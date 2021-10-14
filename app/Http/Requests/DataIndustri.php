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
            // 'id' => 'required',
            'nama' => 'required',
            'bidang' => '',
            'kontak' => '',
            'jurusan' => 'required|array|min:1',
            'jurusan.*' => [
                'required',
                'distinct',
                Rule::in(['AK', 'RPL', 'TKJ']),
            ],
            'tahun' => "required|integer|gte:2020|lte:{$tahun}",
            'alamat' => 'required',
            'kuota' => 'required|integer|min:0',
            'nis_pengaju' => 'required_if:status,==,false|integer',
            'status' => 'boolean',
            'pembimbing' => 'required_with:nip_pembimbing|string',
            'nip_pembimbing' => 'required_with:pembimbing|integer',
        ];
    }
}
