<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Rubrique;

class TypeRubrique extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'state'
    ];

    public function budgetings()
    {
        return $this->hasMany(Rubrique::class);
    }
}
