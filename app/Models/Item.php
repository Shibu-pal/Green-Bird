<?php

namespace App\Models;

use App\Models\Message;
use App\Models\Item_pic;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = [];
    public function item_pics()
    {
        return $this->hasMany(Item_pic::class, 'item_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function messages()
    {
        return $this->hasMany(Message::class, 'item_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'item_id');
    }
}
