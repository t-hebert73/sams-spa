<?php
/**
 * Created by PhpStorm.
 * User: trevor
 * Date: 12/06/18
 * Time: 11:31 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    //const guarded = [];
    protected $fillable = [
        'name'
    ];

    protected $name;

    public function __construct() {
    }
}