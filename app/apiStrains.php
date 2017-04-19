<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $strain_name
 */
class apiStrains extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['strain_name'];

}
