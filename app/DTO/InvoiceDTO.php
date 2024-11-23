<?php

namespace App\DTO;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceDTO implements DTOInterface
{
    public function __construct(
        public int $user_id,
        public int $from_company_id,
        public int $to_company_id,
        public string $start_date,
        public string $end_date
    ) {}

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

    public static function fromRequest(Request $request, User $user = null): self
    {
        if ($user === null) {
            $user = Auth::user();
        }

        return new self(
            user_id: $user->id,
            from_company_id: $user->company_id,
            to_company_id: $request->company_id,
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
}
