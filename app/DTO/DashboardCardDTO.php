<?php

namespace App\DTO;

use App\DTO\Interfaces\DTOInterface;
use Illuminate\Http\Request;

readonly class DashboardCardDTO implements DTOInterface
{
    public function __construct(
        private float $current,
        private float $previous,
        private float $growth,
    ) {}

    public function getCurrent(): float
    {
        return $this->current;
    }

    public function getPrevious(): float
    {
        return $this->previous;
    }

    public function getGrowth(): float
    {
        return $this->growth;
    }

    public static function fromRequest(Request $request): void {}

    public function toArray(): array
    {
        return [
            'current' => $this->getCurrent(),
            'previous' => $this->getPrevious(),
            'growth' => $this->getGrowth(),
        ];
    }
}
