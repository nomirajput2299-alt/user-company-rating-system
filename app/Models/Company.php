<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * Database table associated with the model.
     */
    protected $table = 'companies';

    /**
     * Attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'initial',
        'userId',
        'email',
        'phoneNumber',
        'description',
        'city',
        'status',
    ];

    /**
     * Get the user who created this company.
     *
     * Relationship:
     * One Company belongs to one User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
