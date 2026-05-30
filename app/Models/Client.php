<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    




    protected $fillable = [
        'user_id',
        'branch_id',
        'name',
        'email',
        'phone',
        'photo',
        'status',
    ];

    


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    


    public function routines(): HasMany
    {
        return $this->hasMany(Routine::class);
    }

    


    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    


    public function memberships(): HasMany
    {
        return $this->hasMany(Membership::class);
    }

    


    public function mealPlans(): HasMany
    {
        return $this->hasMany(MealPlan::class);
    }
}
