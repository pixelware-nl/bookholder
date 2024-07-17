<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
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
 */
class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';

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
