<?php

namespace App\Http\Traits;

trait MaskRegexTrait
{
    private array $maskRules = [
        "N" => "[0-9]{1}",
        "A" => "[A-Z]{1}",
        "a" => "[a-z]{1}",
        "X" => "[A-Z0-9]{1}",
        "Z" => "[-_@]{1}"
    ];

    /**
     * Валидация по маске
     * @param string $inputString
     * @param string $mask
     * @return bool
     */
    public function validateByMask(string $inputString, string $mask): bool
    {
        $regex = $this->getRegexMask($mask);
        if (preg_match($regex, $inputString) == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * regex паттерн из маски
     * @param string $mask
     * @return string
     */
    private function getRegexMask(string $mask): string
    {
        $regex = [];
        for ($i = 0; $i < strlen($mask); $i++) {
            if (isset($this->maskRules[$mask[$i]])) {
                $regex[] = $this->maskRules[$mask[$i]];
            }
        }
        return '/' . implode('', $regex) . "$/m";
    }
}
