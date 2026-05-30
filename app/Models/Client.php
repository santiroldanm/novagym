<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'branch_id',
        'name',
        'email',
        'phone',
        'photo',
        'status',
    ];

    /**
     * Get the user that created/manages this client.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the routines for the client.
     */
    public function routines(): HasMany
    {
        return $this->hasMany(Routine::class);
    }

    /**
     * Get the branch the client belongs to.
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Get the memberships for the client.
     */
    public function memberships(): HasMany
    {
        return $this->hasMany(Membership::class);
    }

    /**
     * Get the meal plans for the client.
     */
    public function mealPlans(): HasMany
    {
        return $this->hasMany(MealPlan::class);
    }
}
