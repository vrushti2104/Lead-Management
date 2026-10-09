<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use SoftDeletes;
    public $fillable = [
        'name',
        'email',
        'phone',
        'company_name',
        'status',
        'source',
        'assigned_to',
        'created_by',
        'notes'
    ];

    protected $casts = [
        'status' => 'string',
        'source' => 'string',
    ];

    public function assignedTo()
    {
        return $this->belongsTo(User::class,'assigned_to');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by');
    }
}
