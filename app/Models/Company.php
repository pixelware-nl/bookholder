<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
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
 * @property string $name
 * @property string|null $street_address
 * @property string|null $city
 * @property string|null $province
 * @property string|null $postal_code
 * @property string|null $country
 * @property string|null $phone
 * @property string|null $email
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Product> $products
 * @property-read int|null $products_count
 * @property-read Collection<int, User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company query()
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereStreetAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUpdatedAt($value)
 * @mixin Eloquent
 * @method static Builder|Company withoutAuthenticatedUserCompany()
 * @mixin \Eloquent
 */
class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'kvk',
        'street_address',
        'city',
        'province',
        'postal_code',
        'country',
        'phone',
        'email',
    ];

    public function scopeWithoutAuthenticatedUserCompany(Builder $query): Builder
    {
        return $query->whereNot('id', Auth::user()->company_id);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'company_id', 'id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'company_kvk', 'kvk');
    }
}
