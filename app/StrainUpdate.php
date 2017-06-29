<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $strain_id
 * @property float $height
 * @property float $darkness_time
 * @property float $light_time
 * @property string $stage
 * @property float $veg_prod_quantity
 * @property float $flow_prod_quantity
 * @property float $other_prod_quantity
 * @property string $created_at
 * @property string $updated_at
 * @property Strain $strain
 */
class StrainUpdate extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['strain_id', 'height', 'darkness_time', 'light_time', 'stage', 'veg_prod_quantity', 'flow_prod_quantity', 'other_prod_quantity', 'humidity', 'temp', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function strain()
    {
        return $this->belongsTo('App\Strain');
    }
}
