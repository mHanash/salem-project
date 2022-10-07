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
    ];

    public function budgetings()
    {
        return $this->hasMany(Budgeting::class);
    }
}
