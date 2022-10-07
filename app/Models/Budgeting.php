<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Year;
use App\Models\Currency;
use App\Models\LineBudgeting;

class Budgeting extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'description',
        'year_id',
        'currency_id',
    ];

    public function year()
    {
        return $this->belongsTo(Year::class);
    }
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
    public function lineBugetings()
    {
        return $this->hasMany(LineBudgeting::class);
    }
}
