<?php
/**
 * Created by PhpStorm.
 * User: trevor
 * Date: 21/06/18
 * Time: 9:36 PM
 */

namespace AlescoSalon\Models;


use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    //const guarded = [];
    protected $fillable = [
        'name',
        'email',
        'message',
        'source'
    ];

    protected $name;

    protected $email;

    protected $message;

    protected $source;
}