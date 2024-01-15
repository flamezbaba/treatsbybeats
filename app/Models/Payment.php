<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'payments';
    public $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class, "order_id", "id", $this->order_id);
    }

    public function user()
    {
       return $this->order->user;
    }
}
