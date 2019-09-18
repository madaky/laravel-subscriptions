<?php

   namespace kbtechlabs\LaravelSubscriptions\Models;

    use Illuminate\Database\Eloquent\Model;
    use kbtechlabs\LaravelSubscriptions\Traits\UseUuid;
    class UserPlan extends Model
    {
        use  UseUuid;

        protected $fillable = [
            'id', 
        ];
        public function users(){
            return $this->belongsToMany(\App\User::class);
        }
        public function Plan(){
            return $this->belongsToMany(Plan::class);
        }
    }