<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function item_pics()
    {
        return $this->hasManyThrough(
            Item_pic::class,
            Item::class,
            'id', // Foreign key on Item table...
            'item_id', // Foreign key on Item_pic table...
            'item_id', // Local key on Cart table...
            'id' // Local key on Item table...
        );
    }
}
