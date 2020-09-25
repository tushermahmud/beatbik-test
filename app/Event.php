<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;
    protected $table = 'events';
    protected $fillable = ['title','description','image','created_at','published_at'];
    public function scopePublished($query){
        return $query->where('published_at',1);
    }
}
