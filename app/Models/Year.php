<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Budgeting;

class Year extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'year',
    ];

    public function budgetings()
    {
        return $this->hasMany(Budgeting::class);
    }
}
