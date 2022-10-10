<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Budgeting;
use App\Models\Rubrique;

class LineBudgeting extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'amount',
        'description',
        'budgeting_id',
        'rubrique_id',
    ];

    public function budgeting()
    {
        return $this->belongsTo(Budgeting::class);
    }

    public function rubrique()
    {
        return $this->belongsTo(Rubrique::class);
    }
}
