<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    use HasFactory;
    protected $table = 'adverts';
    public $guarded = [];

    protected $appends = [
        'image_url',
    ];

    function getImageUrlAttribute(){
        return url("storage/app/$this->image");
    }
}
