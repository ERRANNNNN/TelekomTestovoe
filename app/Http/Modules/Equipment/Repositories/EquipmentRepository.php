<?php

namespace App\Http\Modules\Equipment\Repositories;

use App\Http\Modules\Equipment\Models\Equipment;

class EquipmentRepository
{
    /**
     * Вставить записи об оборудовании
     * @param array $values
     * @return void
     */
    public function createEquipment(array $values): void
    {
        Equipment::insert($values);
    }

    /**
     * Обновление оборудования
     * @param int $id
     * @param array $values
     */
    public function updateEquipment(int $id, array $values): void
    {
        Equipment::where('id', '=', $id)
            ->update($values);
    }

    /**
     * Получить по id
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return Equipment::find($id);
    }

    /**
     * Удалить по id
     * @param int $id
     */
    public function deleteById(int $id)
    {
        Equipment::destroy($id);
    }

    /**
     * Получение постранично
     * @param string $search
     * @return mixed
     */
    public function get(string $search = "")
    {
        return Equipment::when($search !== "", function ($query) use ($search){
            $query->where('type_id', 'LIKE', $search);
            $query->orWhere('serial_number', 'LIKE', $search);
            $query->orWhere('comment', 'LIKE', $search);
        })->paginate(15);
    }
}
