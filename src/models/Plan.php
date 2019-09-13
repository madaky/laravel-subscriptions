<?php

   namespace kbtechlabs\LaravelSubscription\Models;

    use Illuminate\Database\Eloquent\Model;

    class Plan extends Model
    {
        protected $fillable = [
            'id', 
            'price', 
            'renew_in'
        ];
        
    }