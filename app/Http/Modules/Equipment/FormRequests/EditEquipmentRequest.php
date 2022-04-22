<?php

namespace App\Http\Modules\Equipment\FormRequests;

use Illuminate\Foundation\Http\FormRequest;

class EditEquipmentRequest extends FormRequest
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
            'type_id' => 'integer',
            'serial_number' => 'unique:equipment',
            'comment' => 'max:32'
        ];
    }
}
