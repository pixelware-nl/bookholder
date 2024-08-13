<?php

namespace App\DTO;

class AbstractDTO
{
    public function toArray(): array
    {
        $array = [];

        foreach ((array)$this as $item) {
            $array []= $item;
        }

        return $array;

        return (array)$this;
    }
}
