<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $author_id
 * @property integer $strain_number
 * @property string $title
 * @property string $state
 * @property boolean $active
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Comment[] $comments
 * @property ReviewUpVote[] $reviewUpVotes
 * @property ReviewUpVote[] $reviewUpVotes
 * @property Strain[] $strains
 */
class Review extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['author_id', 'strain_number', 'title', 'state', 'active', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'author_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment', 'on_review');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviewUpVotes()
    {
        return $this->hasMany('App\ReviewUpVote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviewUpVotes()
    {
        return $this->hasMany('App\ReviewUpVote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function strains()
    {
        return $this->hasMany('App\Strain');
    }
}
