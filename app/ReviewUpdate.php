<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $review_id
 * @property string $update_text
 * @property string $created_at
 * @property string $updated_at
 * @property Review $review
 */
class ReviewUpdate extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['review_id', 'update_text', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function review()
    {
        return $this->belongsTo('App\Review');
    }
}
