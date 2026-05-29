<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Instructor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'specialty',
        'photo',
        'status',
    ];

    /**
     * Get the user associated with the instructor.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the clients for the instructor.
     */
    public function clients(): HasMany
    {
        return $this->hasMany(Client::class, 'user_id', 'user_id');
        // Assuming clients also have user_id referencing the same user (instructor)
    }

    /**
     * Get the routines created by the instructor.
     */
    public function routines(): HasMany
    {
        return $this->hasMany(Routine::class, 'instructor_id');
    }
}