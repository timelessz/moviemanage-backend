<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moviereview extends Model
{
    //
    protected $table = 'movie_review';
    protected $fillable = ['movie_id', 'movie_name', 'content', 'summary', 'title', 'keyword', 'thumbnail', 'type', 'count'];

    public $timestamps = false;

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->created_at = time();
            $model->updated_at = time();
            return true;
        });
        static::updating(function ($model) {
            $model->updated_at = time();
            return true;
        });
    }

}
