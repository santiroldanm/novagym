<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Routine extends Model
{
    use HasFactory;

    




    protected $fillable = [
        'client_id',
        'instructor_id',
        'name',
        'description',
        'difficulty',
    ];

    


    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    


    public function instructor(): BelongsTo
    {
        return $this->belongsTo(Instructor::class);
    }
}