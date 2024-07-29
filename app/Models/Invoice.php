<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon $end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Company|null $fromCompany
 * @property-read \App\Models\Company|null $toCompany
 * @property-read \App\Models\User|null $user
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

    /*
    protected $fillable = [
        'user_id',
        'from_company_id',
        'to_company_id',
        'start_date',
        'end_date',
    ];
*/

    protected $casts = [
        'user_id' => 'integer',
        'from_company_id' => 'integer',
        'to_company_id' => 'integer',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public static function whereUser(User $user)
    {
        return self::where('user_id', $user->id)->get();
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
