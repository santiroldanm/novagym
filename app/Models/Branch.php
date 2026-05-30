<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'schedule',
        'status',
    ];

    /**
     * Get clients registered at this branch.
     */
    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
