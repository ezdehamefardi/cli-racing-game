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
        $choice = strtolower(trim($choice));
        return $choice > 0 && $choice <= 10 ? true : false;
    }
}