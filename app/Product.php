<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $use_time
 * @property string $how_to_use
 * @property string $created_at
 * @property string $updated_at
 * @property ProductOnStrain[] $productOnStrains
 */
class Product extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'use_time', 'how_to_use', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productOnStrains()
    {
        return $this->hasMany('App\ProductOnStrain', 'products_id');
    }
}
