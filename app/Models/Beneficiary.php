<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Job;
use App\Models\Transaction;

class Beneficiary extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'firstname',
        'lastname',
        'job_id',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
