<?php

namespace App\Http\Modules\Equipment;

use App\Http\Modules\Equipment\FormRequests\CreateEquipmentRequest;
use App\Http\Modules\Equipment\FormRequests\EditEquipmentRequest;
use App\Http\Modules\Equipment\Services\EquipmentService;
use App\Http\Modules\Equipment\Services\EquipmentTypesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EquipmentController
{
    /**
     * Получение типов оборудования
     * @param Request $request
     * @param EquipmentTypesService $equipmentTypesService
     * @return JsonResponse
     */
    public function getEquipmentTypes(Request $request, EquipmentTypesService $equipmentTypesService): JsonResponse
    {
        return response()->json($equipmentTypesService->getEquipmentTypes($request));
    }

    /**
     * Создание оборудования
     * @param CreateEquipmentRequest $request
     * @param EquipmentService $equipmentService
     * @return JsonResponse
     */
    public function createEquipment(CreateEquipmentRequest $request, EquipmentService $equipmentService): JsonResponse
    {
        return response()->json($equipmentService->createEquipment($request));
    }

    /**
     * Обновление оборудования по id
     * @param EditEquipmentRequest $request
     * @param EquipmentService $equipmentService
     * @param int $id
     * @return JsonResponse
     */
    public function updateEquipment(EditEquipmentRequest $request, EquipmentService $equipmentService, int $id): JsonResponse
    {
        return response()->json($equipmentService->updateEquipment($request, $id));
    }

    /**
     * Удаление оборудования по id
     * @param EquipmentService $equipmentService
     * @param int $id
     * @return JsonResponse
     */
    public function deleteEquipment(EquipmentService $equipmentService, int $id): JsonResponse
    {
        return response()->json($equipmentService->deleteEquipment($id));
    }

    /**
     * Получение оборудования по id
     * @param EquipmentService $equipmentService
     * @param int $id
     * @return JsonResponse
     */
    public function getEquipmentById(EquipmentService $equipmentService, int $id): JsonResponse
    {
        return response()->json($equipmentService->getById($id));
    }

    /**
     * Получение оборудования постранично
     * @param Request $request
     * @param EquipmentService $equipmentService
     * @return JsonResponse
     */
    public function getEquipment(Request $request, EquipmentService $equipmentService): JsonResponse
    {
        return response()->json($equipmentService->get($request));
    }
}
