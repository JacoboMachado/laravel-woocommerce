<?php

namespace Codexshaper\WooCommerce\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use \Sagalbot\Encryptable\Encryptable;


class Site extends Model
{
    use Encryptable;

    public $timestamps = false;

    protected $fillable = ['url', 'key', 'secret'];

    protected $encryptable = [ 'key', 'secret' ];

}
