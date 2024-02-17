<?php

class Utility
{
    public function prepareJsonData($data): array
    {
        $result = [];

        foreach ($data as $key => $item) {
            $row = [($key+1)];
            foreach ($item as $value) {
                $row[] = $value;
            }
            $result[] = $row;
        }

        return $result;
    }

    public function validateUserInput($choice): bool
    {
        $choice = $this->formatUserInputs($choice);
        return $choice > 0 && $choice <= 10 ? true : false;
    }

    public function formatUserInputs($input): string
    {
        return strtolower(trim($input));
    }

    public function timeCalculator($speed, $unit): float
    {
        // convert all units to km/h
       if ($unit != 'Km/h') {
            $speed = $speed * 1.852;
       }
       
       // the race length is 20KM
       $minutesToFinish = (20 / $speed) * 60;
       return number_format((float)$minutesToFinish, 3, '.', '');
    }    
}