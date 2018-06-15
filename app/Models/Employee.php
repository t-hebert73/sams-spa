<?php
/**
 * Created by PhpStorm.
 * User: trevor
 * Date: 12/06/18
 * Time: 11:00 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //const guarded = [];
    protected $fillable = [
        'name'
    ];

    protected $name;

    public function serviceCategories() {
        return $this->belongsToMany('App\Models\ServiceCategory');
    }

    public function __construct() {
    }
}