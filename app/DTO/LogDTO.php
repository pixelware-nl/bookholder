<?php

namespace App\DTO;

use App\DTO\Interfaces\DTOInterface;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

final readonly class LogDTO implements DTOInterface
{
    public function __construct(
        private int     $companyId,
        private int     $rate,
        private int     $hours,
        private int     $minutes,
        private string  $name,
        private string  $description,
        private ?Carbon $created_at = null,
        private bool    $payed = false,
    ) {}

    public function Log(): Log
    {
        return new Log([
            'company_id' => $this->getCompanyId(),
            'rate' => $this->getRate(),
            'hours' => $this->getHours(),
            'minutes' => $this->getMinutes(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'created_at' => $this->getCreatedAt(),
            'payed' => $this->isPayed(),
        ]);
    }

    public static function fromRequest(Request $request): LogDTO
    {
        return new self(
            $request->company_id,
            $request->rate,
            $request->hours,
            $request->minutes ?? 0,
            $request->name,
            $request->description,
            Carbon::parse($request->created_at),
        );
    }

    public function toArray(): array
    {
        return [
            'company_id' => $this->getCompanyId(),
            'rate' => $this->getRate(),
            'hours' => $this->getHours(),
            'minutes' => $this->getMinutes(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'created_at' => $this->getCreatedAt(),
            'payed' => $this->isPayed(),
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

    public function getMinutes(): int
    {
        return $this->minutes;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCreatedAt(): ?Carbon
    {
        return $this->created_at;
    }

    public function isPayed(): bool
    {
        return $this->payed;
    }
}
