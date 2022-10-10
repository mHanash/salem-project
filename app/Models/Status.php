<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Budgeting;
use App\Models\User;

class Status extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name'
    ];

    public function budgetings()
    {
        return $this->hasMany(Budgeting::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
