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

    /**
     * Get the client associated with this membership.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the instructor associated with this membership (if any).
     */
    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }
}
