<?php

    namespace kbtechlabs\LaravelSubscriptions\Models;

    use Illuminate\Database\Eloquent\Model;
    use kbtechlabs\LaravelSubscriptions\Traits\UseUuid;
    class UserPlanInvoice extends Model
    {
        use  UseUuid;
        
        protected $fillable = [
            'id', 
        ];
        
        public function usertranscation(){
            return $this->belongsTo(config('laravel-subscriptions.models.transcation'),'user_transcation_id');
        }
        
        
    }