<?php

namespace kbtechlabs\LaravelSubscriptions\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model {

    use \kbtechlabs\LaravelSubscriptions\Traits\UseUuid;

    protected $fillable = [
        'id','name','price','durations'
    ];

    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $this->table = config('laravel-subscriptions.plan');
    }

}
