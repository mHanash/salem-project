<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Budgeting;

class Currency extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'currency',
        'description',
    ];

    public function budgetings()
    {
        return $this->hasMany(Budgeting::class);
    }

    public function changes()
    {
        return $this->belongsToMany(Currency::class, 'currency_change', 'currency_id', 'change_id')->withPivot("rate");
    }
    public function currencies()
    {
        return $this->belongsToMany(Currency::class, 'currency_change', 'change_id', 'currency_id')->withPivot("rate");
    }
}
