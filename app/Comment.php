<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $from_user
 * @property integer $on_review
 * @property string $body
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Review $review
 * @property CommentUpVote[] $commentUpVotes
 */
class Comment extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['from_user', 'on_review', 'body', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'from_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function review()
    {
        return $this->belongsTo('App\Review', 'on_review');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commentUpVotes()
    {
        return $this->hasMany('App\CommentUpVote');
    }
}
