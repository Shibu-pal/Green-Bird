<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Item_pic;

class Notification extends Model
{
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    public function reciever()
    {
        return $this->belongsTo(User::class, 'reciever_id');
    }
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function item_pics()
    {
        return $this->hasManyThrough(
            Item_pic::class,
            Item::class,
            'id', // Foreign key on Item table...
            'item_id', // Foreign key on Item_pic table...
            'item_id', // Local key on Notification table...
            'id' // Local key on Item table...
        );
    }

    protected $guarded = [];
}
