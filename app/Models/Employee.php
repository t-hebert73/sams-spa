<?php
/**
 * Created by PhpStorm.
 * User: trevor
 * Date: 12/06/18
 * Time: 11:00 PM
 */

namespace AlescoSalon\Models;


use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //const guarded = [];
    protected $fillable = [
        'name'
    ];

    protected $name;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function serviceCategories() {
        return $this->belongsToMany('AlescoSalon\Models\ServiceCategory');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services() {
        return $this->hasMany('AlescoSalon\Models\Service');
    }

}