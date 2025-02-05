<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Penyidikan extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'no_spdp' => ['required', 'string', 'max:255', 'unique:penyidikan,no_spdp'],
            'tanggal_spdp' => ['required', 'date'],
            'pelaku' => ['required', 'string', 'max:255'],
            'penyidikan_keterangan' => ['nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'no_spdp' => 'No SPDP',
            'tanggal_spdp' => 'Tanggal SPDP',
            'penyidikan_keterangan' => 'Keterangan',
        ];
    }
}