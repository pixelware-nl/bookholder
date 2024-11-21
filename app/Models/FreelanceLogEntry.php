<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

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
 * @property int $product_id
 * @property int $rate
 * @property int $hours
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Product|null $product
 * @method static \Illuminate\Database\Eloquent\Builder|FreelanceLogEntry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FreelanceLogEntry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FreelanceLogEntry query()
 * @method static \Illuminate\Database\Eloquent\Builder|FreelanceLogEntry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreelanceLogEntry whereHours($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreelanceLogEntry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreelanceLogEntry whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreelanceLogEntry whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreelanceLogEntry whereUpdatedAt($value)
 * @mixin Eloquent
 * @property int $user_id
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|FreelanceLogEntry whereUserId($value)
 * @mixin \Eloquent
 */
class FreelanceLogEntry extends Model
{
    use HasFactory;

    protected $table = 'freelance_log_entries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'rate',
        'hours',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
