<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'instructor_id',
        'plan_name',
        'plan_type',
        'price',
        'start_date',
        'end_date',
        'status',
        'notes',
    ];

    


    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    


    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }
}
