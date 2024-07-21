<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RondaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			'mesa' => 'required|string',
			'numeroMesa' => 'required',
			'estado' => 'required|string',
			'mesero' => 'required|string',
			'totalRonda' => 'required',
			'timestamp' => 'required',
			'productos' => 'required|string',
			'cantidades' => 'required|string',
			'descripciones' => 'required|string',
        ];
    }
}
