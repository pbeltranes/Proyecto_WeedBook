<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $products_id
 * @property integer $strains_id
 * @property string $date_start
 * @property string $date_end
 * @property string $created_at
 * @property string $updated_at
 * @property Product $product
 * @property Strain $strain
 */
class ProductOnStrain extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['products_id', 'strains_id', 'date_start', 'date_end', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Product', 'products_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function strain()
    {
        return $this->belongsTo('App\Strain', 'strains_id');
    }
}
