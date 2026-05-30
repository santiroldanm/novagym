<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'instructor_id',
        'name',
        'description',
        'calories',
        'proteins_g',
        'carbs_g',
        'fats_g',
    ];

    /**
     * Get the client this meal plan is assigned to.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the instructor who created this meal plan.
     */
    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }
}
