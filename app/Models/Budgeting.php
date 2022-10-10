<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Year;
use App\Models\Currency;
use App\Models\Rubrique;
use App\Models\LineBudgeting;
use App\Models\Status;
use App\Models\Transaction;

class Budgeting extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'description',
        'start_year_id',
        'end_year_id',
        'currency_id',
        'status_id',
    ];

    public function startYear()
    {
        return $this->belongsTo(Year::class, 'start_year_id');
    }
    public function endYear()
    {
        return $this->belongsTo(Year::class, 'end_year_id');
    }
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function lineBugetings()
    {
        return $this->hasMany(LineBudgeting::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function rubriques()
    {
        return $this->belongsToMany(Rubrique::class);
    }
}
