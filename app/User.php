<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property CommentUpVote[] $commentUpVotes
 * @property Comment[] $comments
 * @property ReviewUpVote[] $reviewUpVotes
 * @property ReviewUpVote[] $reviewUpVotes
 * @property Review[] $reviews
 * @property UsersProfile[] $usersProfiles
 */
class User extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'remember_token', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commentUpVotes()
    {
        return $this->hasMany('App\CommentUpVote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment', 'from_user');
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
    public function reviews()
    {
        return $this->hasMany('App\Review', 'author_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usersProfiles()
    {
        return $this->hasMany('App\UsersProfile');
    }
}
