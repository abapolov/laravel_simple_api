<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Post
 *
 * @package App
 */
class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content'
    ];

    /**
     * @return BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
