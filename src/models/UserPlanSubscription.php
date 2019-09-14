<?php

   namespace kbtechlabs\LaravelSubscriptions\Models;

    use Illuminate\Database\Eloquent\Model;

    class UserPlanSubscription extends Model
    {
        protected $fillable = [
            'id', 
        ];
        public function users(){
            $this->belongsToMany(\App\User::class);
        }
        public function Plan(){
            $this->belongsToMany(Plan::class);
        }
    }