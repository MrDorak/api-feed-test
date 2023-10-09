<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class InstagramProfile extends Model
{
    public $timestamps = true;

    protected $table = 'instagram_profiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'user_id',
        'access_token'
    ];

    public function cacheKey()
    {
        return "instagram_feed:" . $this->id;
    }
}
