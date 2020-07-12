<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class EditUserProduct extends CreateUserProduct
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
        $rule = parent::rules();

        return $rule + [
            'product_id' => 'required',
            'amount' => 'required | numeric',
            'date' => 'date | before_or_equal:today',
        ];
    }
}
