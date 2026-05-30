<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Instructor extends Model
{
    use HasFactory;

    




    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'specialty',
        'photo',
        'status',
    ];

    


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    


    public function clients(): HasMany
    {
        return $this->hasMany(Client::class, 'user_id', 'user_id');
        
    }

    


    public function routines(): HasMany
    {
        return $this->hasMany(Routine::class, 'instructor_id');
    }
}