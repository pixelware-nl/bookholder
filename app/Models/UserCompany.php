<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Company $company
 * @property-read \App\Models\User $user
 * @method static Builder|UserCompany authCreate(int $company_id)
 * @method static Builder|UserCompany authFind(int $company_id)
 * @method static Builder|UserCompany newModelQuery()
 * @method static Builder|UserCompany newQuery()
 * @method static Builder|UserCompany onlyTrashed()
 * @method static Builder|UserCompany query()
 * @method static Builder|UserCompany whereCompanyId($value)
 * @method static Builder|UserCompany whereCreatedAt($value)
 * @method static Builder|UserCompany whereDeletedAt($value)
 * @method static Builder|UserCompany whereId($value)
 * @method static Builder|UserCompany whereUpdatedAt($value)
 * @method static Builder|UserCompany whereUserId($value)
 * @method static Builder|UserCompany withTrashed()
 * @method static Builder|UserCompany withoutTrashed()
 * @mixin \Eloquent
 */
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
            'user_id' => Auth::id(),
            'company_id' => $company_id,
        ]);
    }

    public static function scopeAuthFind(Builder $query, int $company_id): Builder
    {
        return $query->where('user_id', Auth::id())->where('company_id', $company_id)->withTrashed();
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
