<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $comment_id
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property Comment $comment
 * @property User $user
 */
class CommentUpVotes extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['comment_id', 'user_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function comment()
    {
        return $this->belongsTo('App\Comment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
