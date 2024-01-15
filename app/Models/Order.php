<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'orders';
    public $guarded = [];

    protected $casts = [
        'products' => 'array',
        // 'delivery_details' => 'object'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id", $this->user_id);
    }
    
    public function payments()
    {
        return $this->hasMany(Payment::class, "order_id")->orderBy("id", "DESC");
    }
}
