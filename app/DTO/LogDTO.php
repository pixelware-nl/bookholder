<?php

namespace App\DTO;

use App\DTO\Interfaces\DTOInterface;
use App\Exceptions\InvalidRequestToDTOException;
use App\Helpers\ValidationHelper;
use Illuminate\Http\Request;

final readonly class LogDTO implements DTOInterface
{
    private const REQUIRED_ARRAY_PARAMS = [
        'company_id',
        'rate',
        'hours',
        'name',
        'description',
    ];

    public function __construct(
        private int    $companyId,
        private int    $rate,
        private int    $hours,
        private string $name,
        private string $description,
    ) {}

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

    /**
     * @throws InvalidRequestToDTOException
     */
    public static function fromRequest(Request $request): LogDTO
    {
        if (ValidationHelper::isMissingRequiredRequestParams(self::REQUIRED_ARRAY_PARAMS, $request)) {
            throw new InvalidRequestToDTOException();
        }

        return new self(
            $request->input('company_id'),
            $request->input('rate'),
            $request->input('hours'),
            $request->input('name'),
            $request->input('description'),
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
}
