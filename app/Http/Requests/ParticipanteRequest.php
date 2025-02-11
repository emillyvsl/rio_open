<?php

namespace App\Http\Requests;

use App\Rules\ValidarCpf;
use Illuminate\Foundation\Http\FormRequest;

class ParticipanteRequest extends FormRequest
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
           'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:participantes,email',
            'data_nascimento' => 'required|date',
            'cpf' => ['required', 'string', 'unique:participantes,cpf', new ValidarCpf()],
            'tipo_queijo' => 'nullable|string|in:BRIE,CAMEMBERT,GORGONZOLA,EMMENTAL,GRUYERE,GOUDA,PARMESÃO,REINO',
            'termos_aceitos' => 'required|boolean',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */

    public function messages(): array
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O campo nome deve ser uma string.',
            'nome.max' => 'O campo nome deve ter no máximo 255 caracteres.',
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O campo email deve ser um e-mail válido.',
            'email.unique' => 'O e-mail informado já está cadastrado.',
            'data_nascimento.required' => 'O campo data de nascimento é obrigatório.',
            'data_nascimento.date' => 'O campo data de nascimento deve ser uma data válida.',
            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.string' => 'O campo CPF deve ser uma string.',
            'cpf.unique' => 'O CPF informado já está cadastrado.',
            'tipo_queijo.string' => 'O campo tipo de queijo deve ser uma string.',
            'tipo_queijo.in' => 'O campo tipo de queijo deve ser um dos seguintes valores: BRIE, CAMEMBERT, GORGONZOLA, EMMENTAL, GRUYERE, GOUDA, PARMESÃO, REINO.',
            'termos_aceitos.required' => 'O campo termos aceitos são obrigatórioa.',
        ];
    }
}
