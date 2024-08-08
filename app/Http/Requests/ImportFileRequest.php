<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportFileRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'file' => 'required|file|mimes:xlsx,xls,csv',
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'Пожалуйста, загрузите файл.',
            'file.file' => 'Загруженный файл не является excel файлом.',
            'file.mimes' => 'Файл должен быть в формате: xlsx, xls, csv.',
        ];
    }
}
