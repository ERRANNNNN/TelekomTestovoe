<?php

namespace App\Http\Modules\Equipment\Services;

use App\Http\Modules\Equipment\Models\Equipment;
use App\Http\Modules\Equipment\Repositories\EquipmentRepository;
use App\Http\Modules\Equipment\Repositories\EquipmentTypesRepository;
use App\Http\Traits\MaskRegexTrait;
use Illuminate\Http\Request;

class EquipmentService
{
    private EquipmentRepository $equipmentRepository;

    use MaskRegexTrait;

    public function __construct(EquipmentRepository $equipmentRepository)
    {
        $this->equipmentRepository = $equipmentRepository;
    }

    /**
     * Создание оборудования
     * @param Request $request
     * @return array
     */
    public function createEquipment(Request $request): array
    {
        $equipment = $request->post('equipment');
        $equipmentTypesRepository = new EquipmentTypesRepository();
        $result = [];
        $result['error'] = 0;
        $result['errors'] = [];
        foreach ($equipment as $item) {
            $mask = $equipmentTypesRepository->getByID($item['type_id'])->serial_number_mask;
            if (!$this->validateByMask($item['serial_number'], $mask)) {
                $result['errors'][] = "Введенный серийный номер " . $item['serial_number'] . " не совпадает с маской " . $mask;
            }
        }
        if (!empty($result['errors'])) {
            $result['error'] = 1;
            $result['message'] = "Ошибка валидации";
        } else {
            $this->equipmentRepository->createEquipment(array_values($equipment));
            $result['message'] = "Оборудование успешно создано";
        }
        return $result;
    }

    /**
     * Обновление оборудования
     * @param Request $request
     * @param int $id
     * @return array
     */
    public function updateEquipment(Request $request, int $id): array
    {
        $result = [];
        $result['error'] = 0;
        $equipment = $this->equipmentRepository->getById($id);
        if ($equipment !== null) {
            $values = [];
            if ($request->filled('type_id') || $request->filled('serial_number')) {
                $equipmentTypesRepository = new EquipmentTypesRepository();
                if ($request->filled('serial_number')) {
                    $serialNumber = $request->post('serial_number');
                    $values['serial_number'] = $serialNumber;
                } else {
                    $serialNumber = $equipment->serial_number;
                }
                if ($request->filled('type_id')) {
                    $typeId = $request->post('type_id');
                    $values['type_id'] = $typeId;
                } else {
                    $typeId = $equipment->type_id;
                }

                $mask = $equipmentTypesRepository->getByID($typeId)->serial_number_mask;

                if (!$this->validateByMask($serialNumber, $mask)) {
                    $result['error'] = 1;
                    $result['message'] = "Серийный номер " . $serialNumber . " не совпадает с маской типа " . $mask;
                }
            }
            if ($request->filled('comment')) {
                $values['comment'] = $request->post('comment');
            }
            if ($result['error'] === 0) {
                $this->equipmentRepository->updateEquipment($id, $values);
                $result['message'] = "Оборудование сохранено";
            }
        } else {
            $result['error'] = 1;
            $result['message'] = "Оборудования с таким ID не существует";
        }
        return $result;
    }

    /**
     * Удаление оборудования
     * @param int $id
     * @return array
     */
    public function deleteEquipment(int $id): array
    {
        $result = [];
        $result['error'] = 0;
        if ($this->equipmentRepository->getById($id) !== null)
        {
            $this->equipmentRepository->deleteById($id);
            $result['message'] = "Оборудование успешно удалено";
        } else {
            $result['error'] = 1;
            $result['message'] = "Нет оборудования с таким ID";
        }

        return $result;
    }

    /**
     * Получить оборудование по id
     * @param int $id
     * @return array
     */
    public function getById(int $id): array
    {
        $result = [];
        $result['error'] = 0;
        $equipment = $this->equipmentRepository->getById($id);
        if ($equipment !== null)
        {
            $result['equipment'] = $equipment;
        } else {
            $result['error'] = 1;
            $result['message'] = "Нет оборудования с таким ID";
        }
        return $result;
    }

    public function get(Request $request)
    {
        $search = '';
        if ($request->filled('search')) {
            $search = '%' . $request->query("search") . '%';
        }
        return $this->equipmentRepository->get($search);
    }
}
