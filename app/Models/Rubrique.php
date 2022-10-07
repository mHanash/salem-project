<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\TypeRubrique;
use App\Models\LineBudgeting;
use App\Models\Transaction;

class Rubrique extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'type_rubrique_id',
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
}
