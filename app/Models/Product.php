<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    public $guarded = [];

    protected $appends = [
        'image_url', 'category'
    ];

    protected $casts = [
        'categories' => 'array'
    ];

    function getImageUrlAttribute(){
        if($this->image){
            return url("storage/app/$this->image");
        }
        else{
            return url("s3/plate.png");
        }
    }

    function getCategoryAttribute(){
        return implode(", ", (array)$this->categories);
    }
}
