<?php
namespace kbtechlabs\LaravelSubscriptions\Traits;

use Illuminate\Support\Str;

trait UseUuid {
    
    protected static function bootUseUuid()
    {
        static::creating(function ($model) {
            
            $model->uid = (string) Str::uuid();
        });
    }
}
