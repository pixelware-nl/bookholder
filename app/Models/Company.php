<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'street_address',
        'city',
        'province',
        'postal_code',
        'country',
        'phone',
        'email',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'company_id', 'id');
    }
}
