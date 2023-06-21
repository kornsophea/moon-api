<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable=[
        "image"
    ];
    protected $appends = ['image_path'];

    public function getImagePathAttribute() {
        return env('APP_URL').'images/'.$this->image;
    }
}
