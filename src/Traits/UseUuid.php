<?php
namespace kbtechlabs\LaravelSubscriptions\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
trait UseUuid {
    
    protected static function bootUseUuid()
    {
        static::creating(function ($model) {
            if(Schema::hasColumn($model->getTable(),'uid')){
                $model->uid = (string) Str::uuid();
            }
        });
    }
}
