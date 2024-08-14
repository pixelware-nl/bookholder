<?php

namespace App\Models;

use App\Exceptions\InvalidArrayParamsException;
use App\Helpers\ValidationHelper;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
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
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereStreetAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUpdatedAt($value)
 * @mixin Eloquent
 * @method static Builder|Company withoutAuthenticatedUserCompany()
 * @mixin \Eloquent
 */
class Company extends Model
{
    use HasFactory, SoftDeletes;

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
        'postal_code',
        'country'
    ];

    public function scopeWithoutAuthenticatedUserCompany(Builder $query): Builder
    {
        return $query->whereNot('id', Auth::user()->company_id);
    }

    public static function scopeFromKvk(Builder $query, string $kvk): Builder
    {
        return $query->where('kvk', $kvk);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'company_id', 'id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'company_kvk', 'kvk');
    }

    /**
     * @throws InvalidArrayParamsException
     */
    public static function createOrGet(array $array): Company
    {
        $required = ['name', 'kvk', 'street_address', 'city', 'postal_code', 'country'];

        if (ValidationHelper::isMissingRequiredArrayParams($required, $array)) {
            throw new InvalidArrayParamsException();
        }

        $company = Company::fromKvk($array['kvk']);

        if ($company->exists()) {
            return $company->first();
        }

        return Company::create($array);
    }
}
