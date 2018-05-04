<?php
/**
 * Created by PhpStorm.
 * User: trevor
 * Date: 02/05/18
 * Time: 11:51 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @property string title
 * @property string content
 * @property string type
 * @property string perma_link
 * @property string meta_title
 * @property string meta_keywords
 * @property string meta_desc
 * @property array photos
 * @property boolean is_enabled
 */
class Page extends Model
{
    const guarded = [];
    const fillable = [
        'title',
        'content',
        'type',
        'perma_link',
        'meta_title',
        'meta_keywords',
        'meta_desc',
        'is_enabled'
    ];

    protected $title;

    protected $content;

    protected $type;

    protected $perma_link;

    protected $meta_title;

    protected $meta_keywords;

    protected $meta_desc;

    protected $is_enabled;

    public function __construct() {
    }
}