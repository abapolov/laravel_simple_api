<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Comment
 *
 * @package App
 */
class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'post_id', 'text'
    ];

    /**
     * @return BelongsTo
     */
    public function post() {
        return $this->belongsTo(Post::class);
    }

    /**
     * @return BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
