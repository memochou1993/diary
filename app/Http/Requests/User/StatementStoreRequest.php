<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StatementStoreRequest extends FormRequest
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
        /** @var User $user */
        $user = $this->user();

        $resource_ids = $user->resources()->pluck('id');
        $predicate_ids = $user->predicates()->pluck('id');

        return [
            'subject_id' => [
                'required',
                Rule::in($resource_ids),
            ],
            'predicate_id' => [
                'required',
                Rule::in($predicate_ids),
            ],
            'object_id' => [
                'required',
                Rule::in($resource_ids),
            ],
        ];
    }
}
