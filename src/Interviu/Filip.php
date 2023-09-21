<?php
declare(strict_types=1);

namespace App\Interviu;

class Filip
{
    public function verifyCNP($value): bool
    {
        preg_match(
            '/^([1-8])(\d{2})(0[1-9]|1[0-2])(0[1-9]|[12]\d|3[01])(0[1-9]|[1-3]\d|4[0-8]|5[1-2])(\d{3})(\d)$/',
            $value,
            $matches
        );

        if (isset($matches[0])) {

            //daca am judetele 47 si 48 ele sunt valide doar pentru date de nastere anterioare 19.12.1979.
            //aceasta parte este optionala si va fi scoasa dupa decesul persoanelor nascute inainte de 19.12.1979
            if (47 === intval($matches[5]) || 48 === intval($matches[5])) {
                if (intval($matches[1]) > 2) {
                    return false;
                }
                if (intval($matches[2]) > 79) {
                    return false;
                }
                if (intval($matches[3]) == 12 && intval($matches[4]) > 19) {
                    return false;
                }
            }

            $compoentaControl = "279146358279";
            $cnpArray = array_map('intval', str_split($matches[0]));
            $compoentaControlArray = array_map('intval', str_split($compoentaControl));
            $controlSum = 0;
            foreach ($compoentaControlArray as $key => $value) {
                $controlSum += $value * $cnpArray[$key];
            }
            $rest = $controlSum % 11;
            $cComponent = 0;
            if ($rest < 10) {
                $cComponent = $rest;
            }
            if ($rest == 10) {
                $cComponent = 1;
            }
            if ($cComponent === intval($matches[7])) {
                return true;
            }
        }
        return false;
    }

    public function uniqueValuesIgnoreCase($array)
    {
        $lowercaseArray = array_map('strtolower', $array);
        $uniqueValuesArray = array_unique($lowercaseArray);
        return array_intersect_key($array, $uniqueValuesArray);
    }

}