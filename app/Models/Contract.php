<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'year', 'id_card', 'mobile', 'day', 'price', 'deposit', 'remain'
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'day'     => 'datetime:Y-m-d',
    ];

    public static function boot()
{
    parent::boot();

    static::creating(function ($model) {
        $model->deposit = $model->price * 0.1;
        $model->remain = $model->price * 0.9;
    });

    static::updating(function ($model) {
        $model->deposit = $model->price * 0.1;
        $model->remain = $model->price * 0.9;
    });
}

    
}
