<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Routine extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client_id',
        'instructor_id',
        'name',
        'description',
        'difficulty',
    ];

    /**
     * Get the client that owns the routine.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the instructor that created the routine.
     */
    public function instructor(): BelongsTo
    {
        return $this->belongsTo(Instructor::class);
    }
}