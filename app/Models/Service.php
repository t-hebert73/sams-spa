<?php
/**
 * Created by PhpStorm.
 * User: trevor
 * Date: 18/06/18
 * Time: 11:31 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'price'
    ];

    protected $name;

    protected $price;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function serviceCategory() {
        return $this->belongsTo('App\Models\ServiceCategory');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee() {
        return $this->belongsTo('App\Models\Employee');
    }

}