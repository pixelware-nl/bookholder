<?php

namespace App\DTO;

use Illuminate\Http\Request;

interface DTOInterface
{
    public static function fromRequest(Request $request);

    public function toArray(): array;
}
