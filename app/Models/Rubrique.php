<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\TypeRubrique;
use App\Models\LineBudgeting;
use App\Models\Transaction;
use App\Models\Budgeting;

class Rubrique extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'type_rubrique_id',
        'code',
    ];

    public function lineBudgetings()
    {
        return $this->hasMany(LineBudgeting::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function typeRubrique()
    {
        return $this->belongsTo(TypeRubrique::class);
    }

    public function budgetings()
    {
        return $this->belongsToMany(Budgeting::class);
    }
}
