<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * 
 *
 * @method static find(int $get)
 * @method static findOrFail(int $id)
 * @method static firstOrFail(int $id)
 * @method static create(array $array)
 * @method static select(string[] $array)
 * @method static where(string $field, mixed $valueOrOperand, ?mixed $value = null)
 * @method static firstOrCreate(array $array)
 * @method static first()
 * @method static exists()
 * @property int $id
 * @property int $user_id
 * @property int $from_company_id
 * @property int $to_company_id
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Company|null $fromCompany
 * @property-read Company|null $toCompany
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice query()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereFromCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereToCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice forAuthenticatedUser()
 * @property mixed|null $body
 * @property int $payed
 * @method static Builder|Invoice whereBody($value)
 * @method static Builder|Invoice wherePayed($value)
 * @mixin \Eloquent
 */
class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';

    protected $dates = [
        'start_date',
        'end_date'
    ];

    protected $fillable = [
        'user_id',
        'from_company_id',
        'to_company_id',
        'start_date',
        'end_date',
        'body',
        'payed',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'from_company_id' => 'integer',
        'to_company_id' => 'integer',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function getBodyAttribute($value): mixed
    {
        return json_decode($value);
    }

    public function setBodyAttribute(array $value): void
    {
        $this->attributes['body'] = json_encode($value);
    }

    public function fromCompany(): HasOne
    {
        return $this->hasOne(Company::class, 'id', 'from_company_id');
    }

    public function toCompany(): HasOne
    {
        return $this->hasOne(Company::class, 'id', 'to_company_id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
