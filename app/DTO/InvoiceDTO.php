<?php

namespace App\DTO;

use App\DTO\Interfaces\DTOInterface;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final readonly class InvoiceDTO implements DTOInterface
{
    public function __construct(
        private int    $user_id,
        private int    $from_company_id,
        private int    $to_company_id,
        private string $start_date,
        private string $end_date
    ) {}

    public function invoice(): Invoice
    {
        return new Invoice([
            'user_id' => $this->getUserId(),
            'from_company_id' => $this->getFromCompanyId(),
            'to_company_id' => $this->getToCompanyId(),
            'start_date' => $this->getStartDate(),
            'end_date' => $this->getEndDate()
        ]);
    }

    public static function fromRequest(Request $request, User $user = null): self
    {
        if ($user === null) {
            $user = Auth::user();
        }

        return new self(
            user_id: $user->id,
            from_company_id: $user->company_id,
            to_company_id: $request->to_company_id,
            start_date: $request->start_date,
            end_date: $request->end_date
        );
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'from_company_id' => $this->from_company_id,
            'to_company_id' => $this->to_company_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date
        ];
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getFromCompanyId(): int
    {
        return $this->from_company_id;
    }

    public function getToCompanyId(): int
    {
        return $this->to_company_id;
    }

    public function getStartDate(): string
    {
        return $this->start_date;
    }

    public function getEndDate(): string
    {
        return $this->end_date;
    }
}
