<?php

namespace App\Http\Requests;

use App\MiamiOH\StatIncrementRequest;
use Illuminate\Foundation\Http\FormRequest;

class StatIncrement extends FormRequest implements StatIncrementRequest
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
        return [
            //
        ];
    }

    public function source(): string
    {
        return $this->get('source');
    }
}
