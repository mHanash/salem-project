<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Rubrique;
use App\Models\Beneficiary;
use App\Models\Budgeting;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'description',
        'amount',
        'rubrique_id',
        'beneficiary_id',
        'budgeting_id',
        'created_at',
        'date'
    ];

    public function rubrique()
    {
        return $this->belongsTo(Rubrique::class);
    }
    public function budgeting()
    {
        return $this->belongsTo(Budgeting::class);
    }
    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class);
    }
}
