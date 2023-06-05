<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;

    const
        MALE = 0,
        FEMALE = 1;

    const
        LOW_ACTIVITY = 1,
        MIDDLE_ACTIVITY = 2,
        HIGH_ACTIVITY = 3;

    protected $table = "informations";

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'gender',
        'height',
        'weight',
        'birth',
        'activity',
    ];
}
