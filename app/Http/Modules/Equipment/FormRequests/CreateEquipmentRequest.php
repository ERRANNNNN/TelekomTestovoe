<?php

namespace App\Http\Modules\Equipment\FormRequests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEquipmentRequest extends FormRequest
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
            'equipment' => 'required|array',
            'equipment.*.type_id' => 'required|integer',
            'equipment.*.serial_number' => 'required|unique:equipment',
            'comment' => 'max:32'
        ];
    }
}
