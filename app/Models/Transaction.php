<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Rubrique;
use App\Models\Beneficiary;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'description',
        'amount',
        'rubrique_id',
        'beneficiary_id'
    ];

    public function rubrique()
    {
        return $this->belongsTo(Rubrique::class);
    }
    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class);
    }
}
