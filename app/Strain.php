<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $review_id
 * @property string $bank
 * @property string $strain_name
 * @property string $technique
 * @property string $germ_start
 * @property string $veg_start
 * @property string $flow_start
 * @property string $harvest_date
 * @property boolean $active
 * @property string $created_at
 * @property string $updated_at
 * @property string $grow_type
 * @property string $seed_type
 * @property Review $review
 */
class Strain extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['review_id', 'bank', 'strain_name', 'technique', 'germ_start', 'veg_start', 'flow_start', 'harvest_date', 'active', 'created_at', 'updated_at', 'grow_type', 'seed_type'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function review()
    {
        return $this->belongsTo('App\Review');
    }
}
