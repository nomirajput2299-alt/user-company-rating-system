<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    /**
     * Database table associated with the model.
     */
    protected $table = 'feedback';

    /**
     * Attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'phoneNumber',
        'subject',
        'message',
    ];
}
