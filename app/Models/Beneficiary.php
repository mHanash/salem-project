<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Job;
use App\Models\Transaction;
use App\Models\TypeBeneficiary;

class Beneficiary extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'firstname',
        'lastname',
        'job_id',
        'type_beneficiary_id',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function typeBeneficiary()
    {
        return $this->belongsTo(TypeBeneficiary::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
