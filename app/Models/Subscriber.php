<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subscribers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'subscribed_at', // Allow setting this if needed, though default works
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'subscribed_at' => 'datetime',
    ];

    // Disable updated_at if you only care about created_at and subscribed_at
    public $timestamps = true; // Keep created_at and updated_at
    // const UPDATED_AT = null; // Uncomment this if you don't need updated_at
}