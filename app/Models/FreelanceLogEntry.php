<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FreelanceLogEntry extends Model
{
    use HasFactory;

    protected $table = 'freelance_log_entries';

    protected $fillable = [
        'product_id',
        'rate',
        'hours',
    ];

    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
