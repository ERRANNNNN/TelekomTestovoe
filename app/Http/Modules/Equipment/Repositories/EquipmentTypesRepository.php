<?php

namespace App\Http\Modules\Equipment\Repositories;

use App\Http\Modules\Equipment\Models\Equipment_types;

class EquipmentTypesRepository
{
    /**
     * Получение постранично
     * @param string $search
     * @return mixed
     */
    public function get(string $search = "")
    {
        return Equipment_types::when($search !== "", function ($query) use ($search){
            $query->where('name', 'LIKE', $search);
            $query->orWhere('serial_number_mask', 'LIKE', $search);
        })->paginate(15);
    }

    /**
     * Получение по id
     * @param int $typeID
     * @return mixed
     */
    public function getByID(int $typeID)
    {
        return Equipment_types::find($typeID);
    }
}
