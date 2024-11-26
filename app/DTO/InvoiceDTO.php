<?php

namespace App\DTO;

use App\DTO\Interfaces\DTOInterface;
use App\Models\Company;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

final class InvoiceDTO implements DTOInterface
{
    public function __construct(
        private readonly int    $user_id,
        private readonly int    $from_company_id,
        private readonly int    $to_company_id,
        private readonly Carbon $start_date,
        private readonly Carbon $end_date,
        private ?array          $body = null
    ) {}

    public function invoice(): Invoice
    {
        return new Invoice([
            'user_id' => $this->getUserId(),
            'from_company_id' => $this->getFromCompanyId(),
            'to_company_id' => $this->getToCompanyId(),
            'start_date' => $this->getStartDate(),
            'end_date' => $this->getEndDate(),
            'body' => $this->getBody()
        ]);
    }

    public function fromCompany(): Company
    {
        return Company::find($this->getFromCompanyId());
    }

    public function toCompany(): Company
    {
        return Company::find($this->getToCompanyId());
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

    public function getStartDate(): Carbon
    {
        return $this->start_date;
    }

    public function getEndDate(): Carbon
    {
        return $this->end_date;
    }

    public function getBody(): ?array
    {
        return $this->body;
    }

    public function setBody(array $body): void
    {
        $this->body = $body;
    }
}
