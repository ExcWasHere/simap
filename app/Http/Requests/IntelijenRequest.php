<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IntelijenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'no_nhi' => ['required', 'string', 'max:255', 'unique:intelijen,no_nhi'],
            'tanggal_nhi' => ['required', 'date'],
            'tempat' => ['required', 'string', 'max:255'],
            'jenis_barang' => ['required', 'string', 'max:255'],
            'jumlah_barang' => ['required', 'integer', 'min:1'],
            'kemasan' => ['nullable', 'string', 'in:liter,batang'],
            'intelijen_keterangan' => ['nullable', 'string']
        ];
    }
}
