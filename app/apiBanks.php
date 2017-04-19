<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $bank_name
 */
class apiBanks extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['bank_name'];

}
