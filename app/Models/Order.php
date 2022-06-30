<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'orders';

    protected $fillable = ['user_id', 'currency_id', 'amount', 'fee'];

    public function users()
    {
        return self::hasMany(User::class, 'user_id');
    }

    public function currency()
    {
        return self::hasMany(Currency::class, 'currency_id');
    }
}
