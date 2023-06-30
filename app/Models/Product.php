<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    const
        STAR = 'star',
        FIRE = 'fire';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'title',
        'description',
        'image_src',
        'video_src',
        'price',
        'weight',
        'length',
        'height',
        'depth',
        'icon',
        'status',
    ];

    /**
     * Get the value of the your_column attribute.
     *
     * @param  string  $value
     * @return string
     */
    public function getLengthAttribute($value)
    {
        $trimmedValue = rtrim($value, '0');
        return rtrim($trimmedValue, '.');
    }

    /**
     * Get the value of the your_column attribute.
     *
     * @param  string  $value
     * @return string
     */
    public function getHeightAttribute($value)
    {
        $trimmedValue = rtrim($value, '0');
        return rtrim($trimmedValue, '.');
    }

    /**
     * Get the value of the your_column attribute.
     *
     * @param  string  $value
     * @return string
     */
    public function getDepthAttribute($value)
    {
        $trimmedValue = rtrim($value, '0');
        return rtrim($trimmedValue, '.');
    }
}
