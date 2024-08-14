<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCompany extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_companies';

    protected $fillable = [
        'user_id',
        'company_id',
    ];

    public static function scopeAuthCreate(Builder $query, int $company_id): UserCompany
    {
        return $query->create([
            'user_id' => \Auth::id(),
            'company_id' => $company_id,
        ]);
    }

    public static function scopeAuthFind(Builder $query, int $company_id): Builder
    {
        return $query->where('user_id', \Auth::id())->where('company_id', $company_id);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
