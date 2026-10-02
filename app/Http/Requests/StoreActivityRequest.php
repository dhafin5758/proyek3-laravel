<?php
// app/Http/Requests/StoreActivityRequest.php
namespace App\Http\Requests;

// rules() disini sengaja dipisah dari UpdateActivityRequest supaya nanti bisa dikembangkan sendiri-sendiri
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreActivityRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'category_id'  => ['required', 'exists:categories,id'],
            'code'         => ['required', 'string', 'max:30', 'unique:activities,code'],
            'title'        => ['required', 'string', 'min:5', 'max:150'],
            'description'  => ['nullable', 'string', 'max:1000'],
            'location'     => ['nullable', 'string', 'max:150'],
            'capacity'     => ['required', 'integer', 'min:1', 'max:500'],
            'start_at'     => ['required', 'date'],
            'end_at'       => ['required', 'date', 'after_or_equal:start_at'],
            'status'       => ['required', Rule::in(['draft', 'published', 'completed'])],
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.exists' => 'Kategori tidak ditemukan.',
            'code.unique'        => 'Kode kegiatan sudah dipakai.',
            'title.min'          => 'Judul minimal 5 karakter.',
            'end_at.after_or_equal' => 'Tanggal selesai tidak boleh lebih awal dari tanggal mulai.',
            'capacity.max'       => 'Kapasitas maksimal 500 peserta.',
        ];
    }
}
