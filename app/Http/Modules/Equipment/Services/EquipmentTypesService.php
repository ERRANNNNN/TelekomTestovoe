<?php

namespace App\Http\Modules\Equipment\Services;

use App\Http\Modules\Equipment\Repositories\EquipmentTypesRepository;
use Illuminate\Http\Request;

class EquipmentTypesService
{
    private EquipmentTypesRepository $equipmentTypesRepository;

    public function __construct(EquipmentTypesRepository $repository)
    {
        $this->equipmentTypesRepository = $repository;
    }

    /**
     * Получение списка типов оборудования
     * @param Request $request
     * @return mixed
     */
    public function getEquipmentTypes(Request $request)
    {
        $search = '';
        if ($request->filled('search')) {
            $search = '%' . $request->query("search") . '%';
        }
        return $this->equipmentTypesRepository->get($search);
    }
}
