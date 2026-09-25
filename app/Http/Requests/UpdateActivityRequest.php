<?php
// app/Http/Requests/UpdateActivityRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


// rules() disini sengaja dipisah dari StoreActivityRequest supaya nanti bisa dikembangkan sendiri-sendiri
class UpdateActivityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:5', 'max:100'],
            'description' => ['nullable', 'string', 'max:1000'],
            'activity_date' => ['required', 'date'],
            'category' => ['required', 'string', 'max:50'],
            'status' => [
                'required',
                Rule::in(['Planned', 'Ongoing', 'Done']),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'title.min' => 'Judul kegiatan minimal 5 karakter.',
            'title.max' => 'Judul kegiatan maksimal 100 karakter.',
            'title.required' => 'Judul kegiatan wajib diisi.',
            'activity_date.required' => 'Tanggal kegiatan wajib diisi.',
            'activity_date.date' => 'Tanggal kegiatan harus berupa tanggal yang valid.',
            'status.in' => 'Status hanya boleh berisi Planned, Ongoing, atau Done.',
            'category.required' => 'Kategori wajib diisi.',
        ];
    }
}
