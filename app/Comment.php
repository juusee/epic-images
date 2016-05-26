<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user', 'content', 'image_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function image() {
        return $this->belongsTo(Image::class);
    }
}
