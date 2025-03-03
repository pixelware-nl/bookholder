<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
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
 * @property string $kvk
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $employees
 * @property-read int|null $employees_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $partners
 * @property-read int|null $partners_count
 * @method static Builder|Company fromKvk(string $kvk)
 * @method static Builder|Company whereKvk($value)
 * @property string|null $iban
 * @method static Builder|Company whereIban($value)
 * @mixin \Eloquent
 */
	class Company extends \Eloquent {}
}

namespace App\Models{
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
	class Invoice extends \Eloquent {}
}

namespace App\Models{
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
 * @method static \Illuminate\Database\Eloquent\Builder|Log newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Log newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Log query()
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereHours($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereUpdatedAt($value)
 * @mixin Eloquent
 * @property int $user_id
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereUserId($value)
 * @property int $company_id
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereCompanyId($value)
 * @property-read \App\Models\Company|null $company
 * @property string $name
 * @property string $description
 * @property int $payed
 * @method static Builder|Log whereDescription($value)
 * @method static Builder|Log whereName($value)
 * @method static Builder|Log wherePayed($value)
 * @mixin \Eloquent
 */
	class Log extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $full_name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $company_kvk
 * @property-read \App\Models\Company $company
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @property int $company_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property-read int|null $companies_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Log> $logs
 * @property-read int|null $logs_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @mixin \Eloquent
 */
	class User extends \Eloquent {}
}

namespace App\Models{
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
	class UserCompany extends \Eloquent {}
}

