<?php

namespace Codexshaper\WooCommerce\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;


class Sites extends Model
{
    public $timestamps = false;

    public static function create(array $request)
    {
        
        return static::query()->create([
            'url' => $request->url,
            'key' => encrypt($request->key),
            'secret' => encrypt($request->secret)
        ]);
    }

    public function scopeDecryptKeys()
    {
        $response = $this;
        // $response = static::query()->find($id);
        // if ($response->isEmpty()) {
        //     return new static;
        // }
        $response->key = $response->decrypt($response->key);
        $response->secret = $response->decrypt($response->secret);

        return $response;

    }

}
