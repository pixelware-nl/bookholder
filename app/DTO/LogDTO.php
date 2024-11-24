<?php

namespace App\DTO;

use App\DTO\Interfaces\DTOInterface;
use App\Models\Log;
use Illuminate\Http\Request;

final readonly class LogDTO implements DTOInterface
{
    public function __construct(
        private int    $companyId,
        private int    $rate,
        private int    $hours,
        private string $name,
        private string $description,
    ) {}

    public function Log(): Log
    {
        return new Log([
            'company_id' => $this->getCompanyId(),
            'rate' => $this->getRate(),
            'hours' => $this->getHours(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
        ]);
    }

    public static function fromRequest(Request $request): LogDTO
    {
        return new self(
            $request->company_id,
            $request->rate,
            $request->hours,
            $request->name,
            $request->description,
        );
    }

    public function toArray(): array
    {
        return [
            'company_id' => $this->getCompanyId(),
            'rate' => $this->getRate(),
            'hours' => $this->getHours(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
        ];
    }

    public function getCompanyId(): int
    {
        return $this->companyId;
    }

    public function getRate(): int
    {
        return $this->rate;
    }

    public function getHours(): int
    {
        return $this->hours;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
